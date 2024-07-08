```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# interface SearchInterface (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Interfaces**
> extends: ****
```uml
@startuml
interface SearchInterface  #Lavender {
  + get(string $table) : ?array
  + value(mixed $value, int $id, ...) : bool
  + reset(string $table) : void
}

note right of SearchInterface::get
  Get found values

  since: 3.2.0
  return: ?array
end note

note right of SearchInterface::value
  Search inside a value

  since: 3.2.0
  return: bool
  
  arguments:
    mixed $value
    int $id
    string $field
    string $table
end note

note right of SearchInterface::reset
  Empty the found values

  since: 3.2.0
  return: void
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

