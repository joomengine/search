```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Load (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Database**
```uml
@startuml
class Load  #Gold {
  # int $bundle
  # Config $config
  # Table $table
  # Model $model
  # Database $load
  + __construct(?Config $config = null, ?Table $table = null, ...)
  + value(int $id, string $field, ...) : mixed
  + item(int $id, string $table = null) : ?object
  + items(string $table = null, int $bundle) : ?array
  # next(string $table, int $bundle) : int
  # incremental(int $bundle) : int
  # setDatabaseFields(string $table, string $key = 'a', ...) : ?array
}

note right of Load::__construct
  Constructor

  since: 3.2.0
  
  arguments:
    ?Config $config = null
    ?Table $table = null
    ?Model $model = null
    ?Database $load = null
end note

note right of Load::value
  Get a value from a given table
Example: $this->value(23, 'value_key', 'table_name');

  since: 3.2.0
  return: mixed
  
  arguments:
    int $id
    string $field
    string $table = null
end note

note right of Load::item
  Get values from a given table
Example: $this->item(23, 'table_name');

  since: 3.2.0
  return: ?object
end note

note right of Load::items
  Get values from a given table
Example: $this->items('table_name');

  since: 3.2.0
  return: ?array
end note

note right of Load::next
  Get next id to call

  since: 3.2.0
  return: int
end note

note right of Load::incremental
  Get Incremental number where the set starts

  since: 3.2.0
  return: int
end note

note right of Load::setDatabaseFields
  Get Fields ready to use in database call

  since: 3.2.0
  return: ?array
  
  arguments:
    string $table
    string $key = 'a'
    bool $addId = true
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

