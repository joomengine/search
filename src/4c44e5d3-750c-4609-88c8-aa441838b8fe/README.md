```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# interface InsertInterface (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Interfaces**
> extends: ****
```uml
@startuml
interface InsertInterface  #Lavender {
  + value(mixed $value, int $id, ...) : bool
  + item(object $item, ?string $table = null) : bool
  + items(array $items, string $table = null) : bool
}

note right of InsertInterface::value
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

note right of InsertInterface::item
  Set values to a given table
Example: $this->item(Object, 23, 'table_name');

  since: 3.2.0
  return: bool
end note

note right of InsertInterface::items
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

