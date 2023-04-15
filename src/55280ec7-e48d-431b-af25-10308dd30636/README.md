```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# interface FindInterface (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Interfaces**
```uml
@startuml
interface FindInterface  #Lavender {
  + get(?string $table = null) : ?array
  + item(object $item, ?int $id = null, ...) : void
  + items(?array $items = null, ?string $table = null) : void
  + reset(?string $table = null) : void
}

note right of FindInterface::get
  Get found values

  since: 3.2.0
  return: ?array
end note

note right of FindInterface::item
  Search over an item fields

  since: 3.2.0
  return: void
  
  arguments:
    object $item
    ?int $id = null
    ?string $table = null
end note

note right of FindInterface::items
  Search over an array of items

  since: 3.2.0
  return: void
end note

note right of FindInterface::reset
  Reset all found values of a table

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

