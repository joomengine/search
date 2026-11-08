<?php

// These doubles isolate the database boundary; the search repository classes below
// are loaded unchanged. They are not substitutes for a Joomla integration test.
namespace VDM\Joomla\Interfaces {
    interface TableInterface {}
    interface ModelInterface {}
}

namespace VDM\Joomla\Componentbuilder {
    class Table implements \VDM\Joomla\Interfaces\TableInterface
    {
        public function fields(string $table, bool $default = false): ?array
        {
            return $default ? ['id', 'title', 'code'] : ['title', 'code'];
        }

        public function titleName(string $table): string
        {
            return 'title';
        }

        public function get(string $table, string $field, string $key)
        {
            return null;
        }
    }
}

namespace VDM\Joomla\Abstraction {
    abstract class Model
    {
        protected \VDM\Joomla\Interfaces\TableInterface $table;
        protected array $lastIds = [];

        public function __construct(\VDM\Joomla\Interfaces\TableInterface $table)
        {
            $this->table = $table;
        }

        // Reflect the external base Model's validation and key-plus-value rule.
        public function item(?object $item, ?string $table = null): ?object
        {
            if ($item === null) {
                return null;
            }
            $result = new \stdClass();
            foreach ($this->table->fields($table, true) as $field) {
                if (!isset($item->{$field}) || !$this->validateBefore($item->{$field}, $field, $table)) {
                    continue;
                }
                $item->{$field} = $this->value($item->{$field}, $field, $table);
                if ($this->validateAfter($item->{$field}, $field, $table)) {
                    $result->{$field} = $item->{$field};
                }
            }
            return count(get_object_vars($result)) > 1 ? $result : null;
        }

        public function items(?array $items = null, ?string $table = null): ?array
        {
            $result = [];
            foreach ($items ?? [] as $id => $item) {
                $modelled = $this->item($item, $table);
                if ($modelled !== null) {
                    $result[$id] = $modelled;
                    $this->lastIds[$table] = $modelled->id ?? $this->lastIds[$table] ?? null;
                }
            }
            return $result ?: null;
        }

        public function last(?string $table = null): ?int
        {
            return $this->lastIds[$table] ?? null;
        }
    }
}

namespace VDM\Joomla\Database {
    // The external Load is final. This test-only seam allows a deterministic
    // in-memory query double without a Joomla connection or database service.
    class Load {}
}

namespace {
    use Joomla\Input\Input;
    use VDM\Joomla\Componentbuilder\Search\Agent;
    use VDM\Joomla\Componentbuilder\Search\Agent\Find;
    use VDM\Joomla\Componentbuilder\Search\Agent\Replace;
    use VDM\Joomla\Componentbuilder\Search\Agent\Search;
    use VDM\Joomla\Componentbuilder\Search\Agent\Update;
    use VDM\Joomla\Componentbuilder\Search\Config;
    use VDM\Joomla\Componentbuilder\Search\Database\Load;
    use VDM\Joomla\Componentbuilder\Search\Database\Insert;
    use VDM\Joomla\Componentbuilder\Search\Engine\Basic;
    use VDM\Joomla\Componentbuilder\Table;

    function auditConfig(): Config
    {
        return new Config(new Input([
            'search_value' => 'needle',
            'replace_value' => 'replacement',
            'table_name' => 'example',
        ]));
    }

    class AuditDatabase extends \VDM\Joomla\Database\Load
    {
        public array $rows;
        public array $calls = [];

        public function __construct(array $rows)
        {
            $this->rows = $rows;
        }

        public function items($fields, $tables, $where, $order, $limit): ?array
        {
            $this->calls[] = [$where, $order, $limit];
            $minimum = $where['a.id']['value'] ?? 1;
            $rows = array_filter($this->rows, static function ($row) use ($minimum) {
                return $row->id >= $minimum;
            });
            $field = array_key_first($order) === 'a.id' ? 'id' : 'title';
            usort($rows, static function ($left, $right) use ($field) {
                return $left->{$field} <=> $right->{$field};
            });
            if ($limit !== null) {
                $rows = array_slice($rows, 0, $limit);
            }
            $result = [];
            foreach ($rows as $row) {
                $result[$row->id] = clone $row;
            }
            return $result ?: null;
        }
    }

    class AuditLoadModel extends \VDM\Joomla\Componentbuilder\Search\Model\Load
    {
        protected ?int $lastRetained = null;

        public function items(?array $items = null, ?string $table = null): ?array
        {
            $items = array_filter($items ?? [], static function ($item) {
                return $item->code !== '';
            });
            if ($items) {
                $this->lastRetained = (int) end($items)->id;
            }
            return $items ?: null;
        }

        public function last(?string $table = null): ?int
        {
            return $this->lastRetained;
        }
    }

    class AuditPagedLoad extends Load
    {
        protected int $bundle = 2;
    }

    class AuditInsertModel extends \VDM\Joomla\Componentbuilder\Search\Model\Insert
    {
        public function validate($value): bool
        {
            return $this->validateBefore($value, 'code', 'example');
        }
    }

    class AuditInsert extends Insert
    {
        public array $written = [];

        public function __construct() {}

        public function items(?array $items, string $table = null): bool
        {
            $this->written[] = $items;
            return !empty($items);
        }
    }

    function auditLoader(array $rows): array
    {
        $config = auditConfig();
        $table = new Table();
        $database = new AuditDatabase($rows);
        $model = new AuditLoadModel($config, $table);
        return [new AuditPagedLoad($config, $table, $model, $database), $database];
    }

    test('pagination visits IDs once even when titles are in reverse order', function () {
        [$loader, $database] = auditLoader([
            (object) ['id' => 1, 'title' => 'z', 'code' => 'needle'],
            (object) ['id' => 2, 'title' => 'c', 'code' => 'needle'],
            (object) ['id' => 3, 'title' => 'b', 'code' => 'needle'],
            (object) ['id' => 4, 'title' => 'a', 'code' => 'needle'],
        ]);
        same([1, 2], array_keys($loader->items('example', 1)));
        same([3, 4], array_keys($loader->items('example', 2)));
        same(null, $loader->items('example', 3));
        same(['a.id' => 'ASC'], $database->calls[0][1]);
        same([1, 2], array_keys($loader->items('example', 1)));
        same([4, 3, 2, 1], array_keys($loader->items('example')));
    });

    test('pagination crosses filtered batches and sparse IDs', function () {
        [$loader, $database] = auditLoader([
            (object) ['id' => 2, 'title' => 'a', 'code' => ''],
            (object) ['id' => 8, 'title' => 'b', 'code' => ''],
            (object) ['id' => 12, 'title' => 'c', 'code' => 'needle'],
            (object) ['id' => 20, 'title' => 'd', 'code' => ''],
            (object) ['id' => 31, 'title' => 'e', 'code' => 'needle'],
        ]);
        same([12], array_keys($loader->items('example', 1)));
        same([31], array_keys($loader->items('example', 2)));
        same(null, $loader->items('example', 3));
        same([1, 9, 21, 32], array_map(static function ($call) {
            return $call[0]['a.id']['value'];
        }, $database->calls));
    });

    test('Insert model validation resolves shared StringHelper', function () {
        $model = new AuditInsertModel(auditConfig(), new Table());
        truth($model->validate('needle'));
        truth(!$model->validate(''));
    });

    test('Load model preserves integer IDs with only one searchable string field', function () {
        $model = new \VDM\Joomla\Componentbuilder\Search\Model\Load(auditConfig(), new Table());
        foreach ([42, '42'] as $id) {
            $items = $model->items([42 => (object) ['id' => $id, 'title' => '', 'code' => 'needle']], 'example');
            truth($items !== null);
            same($id, $items[42]->id);
            same('needle', $items[42]->code);
            same(42, $model->last('example'));
        }
        same(null, $model->item((object) ['id' => 42, 'code' => 123], 'example'));
    });

    test('Find and Replace use object IDs for lists and discard stale item state', function () {
        $config = auditConfig();
        $engine = new Basic($config);
        $search = new Search($config, $engine);
        $find = new Find($config, $search);
        $replace = new Replace($config, new Update($engine));
        $items = [
            (object) ['id' => 42, 'code' => 'needle'],
            (object) ['id' => 77, 'code' => 'needle'],
        ];
        $find->items($items, 'example');
        $replace->items($items, 'example');
        same([42, 77], array_keys($find->get('example')));
        same([42, 77], array_keys($replace->get('example')));
        $find->item((object) ['id' => 77, 'code' => 'absent'], null, 'example');
        $replace->item((object) ['id' => 77, 'code' => 'absent'], null, 'example');
        same([42], array_keys($find->get('example')));
        same([42], array_keys($replace->get('example')));
    });

    test('shared Agent starts each operation with fresh result buckets', function () {
        [$loader, $database] = auditLoader([
            (object) ['id' => 42, 'title' => 'sample', 'code' => 'needle'],
        ]);
        $config = auditConfig();
        $engine = new Basic($config);
        $search = new Search($config, $engine);
        $update = new Update($engine);
        $find = new Find($config, $search);
        $replace = new Replace($config, $update);
        $insert = new AuditInsert();
        $agent = new Agent($config, $loader, $insert, $find, $replace, $search, $update, new Table());
        truth($agent->find('example') !== null);
        $database->rows = [];
        same(null, $agent->find('example'));
        $find->item((object) ['id' => 99, 'code' => 'needle'], null, 'example');
        $replace->item((object) ['id' => 98, 'code' => 'needle'], null, 'example');
        $database->rows = [(object) ['id' => 42, 'title' => 'sample', 'code' => 'absent']];
        same(0, $agent->replace('example'));
        same([null], $insert->written);
    });
}
