```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Find (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Agent**
> extends: ****
```uml
@startuml
class Find  #Gold {
  # array $found
  # Config $config
  # Search $search
  + __construct(?Config $config = null, ?Search $search = null)
  + get(?string $table = null) : ?array
  + item(object $item, ?int $id = null, ...) : void
  + items(?array $items = null, ?string $table = null) : void
  + reset(?string $table = null) : void
}

note right of Find::__construct
  Constructor

  since: 3.2.0
end note

note right of Find::get
  Get found values

  since: 3.2.0
  return: ?array
end note

note right of Find::item
  Search over an item fields

  since: 3.2.0
  return: void
  
  arguments:
    object $item
    ?int $id = null
    ?string $table = null
end note

note right of Find::items
  Search over an array of items

  since: 3.2.0
  return: void
end note

note right of Find::reset
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

