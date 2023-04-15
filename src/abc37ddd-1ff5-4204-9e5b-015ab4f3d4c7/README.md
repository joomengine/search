```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Replace (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Agent**
```uml
@startuml
class Replace  #Gold {
  # array $updated
  # Config $config
  # Update $update
  + __construct(?Config $config = null, ?Update $update = null)
  + get(?string $table = null) : ?array
  + item(object $item, ?int $id = null, ...) : void
  + items(?array $items = null, ?string $table = null) : void
  + reset(?string $table = null) : void
}

note right of Replace::__construct
  Constructor

  since: 3.2.0
end note

note right of Replace::get
  Get updated values

  since: 3.2.0
  return: ?array
end note

note right of Replace::item
  Search over an item fields

  since: 3.2.0
  return: void
  
  arguments:
    object $item
    ?int $id = null
    ?string $table = null
end note

note right of Replace::items
  Search over an array of items

  since: 3.2.0
  return: void
end note

note right of Replace::reset
  Reset all updated values of a table

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

