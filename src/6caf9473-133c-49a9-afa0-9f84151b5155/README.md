```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Insert (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Database**
```uml
@startuml
class Insert  #Gold {
  # Config $config
  # Table $table
  # Model $model
  # $db
  + __construct(?Config $config = null, ?Table $table = null, ...)
  + value(mixed $value, int $id, ...) : bool
  + item(object $item, ?string $table = null) : bool
  + items(?array $items, string $table = null) : bool
}

note right of Insert::__construct
  Constructor

  since: 3.2.0
  
  arguments:
    ?Config $config = null
    ?Table $table = null
    ?Model $model = null
end note

note right of Insert::value
  Set values to a given table
Example: $this->value(Value, 23, 'value_key', 'table_name');

  since: 3.2.0
  return: bool
  
  arguments:
    mixed $value
    int $id
    string $field
    ?string $table = null
end note

note right of Insert::item
  Set values to a given table
Example: $this->item(Object, 'table_name');

  since: 3.2.0
  return: bool
end note

note right of Insert::items
  Set values to a given table
Example: $this->items(Array, 'table_name');

  since: 3.2.0
  return: bool
end note
 
@enduml
```

---
```
     ██╗ ██████╗██████╗
     ██║██╔════╝██╔══██╗
     ██║██║     ██████╔╝
██   ██║██║     ██╔══██╗
╚█████╔╝╚██████╗██████╔╝
 ╚════╝  ╚═════╝╚═════╝
```
> Build with [Joomla Component Builder](https://git.vdm.dev/joomla/Component-Builder)

