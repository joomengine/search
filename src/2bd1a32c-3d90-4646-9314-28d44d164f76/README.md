```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# interface LoadInterface (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Interfaces**
```uml
@startuml
interface LoadInterface  #Lavender {
  + value(int $id, string $field, ...) : mixed
  + item(int $id, string $table = null) : ?object
  + items(string $table = null, int $bundle) : ?array
}

note right of LoadInterface::value
  Get a value from a given table
Example: $this->value(23, 'value_key', 'table_name');

  since: 3.2.0
  return: mixed
  
  arguments:
    int $id
    string $field
    string $table = null
end note

note right of LoadInterface::item
  Get values from a given table
Example: $this->item(23, 'table_name');

  since: 3.2.0
  return: ?object
end note

note right of LoadInterface::items
  Get values from a given table
Example: $this->items('table_name');

  since: 3.2.0
  return: ?array
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

