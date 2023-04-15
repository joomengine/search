```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Load (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Model**
```uml
@startuml
class Load  #Gold {
  # Config $config
  + __construct(?Config $config = null, ?Table $table = null)
  + value(mixed $value, string $field, ...) : mixed
  # validateBefore(mixed $value, ?string $field = null, ...) : bool
  # validateAfter(mixed $value, ?string $field = null, ...) : bool
  # getTable() : string
}

note right of Load::__construct
  Constructor

  since: 3.2.0
end note

note right of Load::value
  Model the value
Example: $this->value(value, 'value_key', 'table_name');

  since: 3.2.0
  return: mixed
  
  arguments:
    mixed $value
    string $field
    ?string $table = null
end note

note right of Load::validateBefore
  Validate before the value is modelled (basic, override in child class)

  since: 3.2.0
  return: bool
  
  arguments:
    mixed $value
    ?string $field = null
    ?string $table = null
end note

note right of Load::validateAfter
  Validate after the value is modelled (basic, override in child class)

  since: 3.2.0
  return: bool
  
  arguments:
    mixed $value
    ?string $field = null
    ?string $table = null
end note

note right of Load::getTable
  Get the current active table

  since: 3.2.0
  return: string
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

