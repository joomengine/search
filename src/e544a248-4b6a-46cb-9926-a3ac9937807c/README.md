```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Search (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Agent**
```uml
@startuml
class Search  #Gold {
  # array $found
  # Config $config
  # SearchEngine $search
  + __construct(?Config $config = null, ?SearchEngine $search = null)
  + get(string $table) : ?array
  + value(mixed $value, int $id, ...) : bool
  + reset(string $table) : void
  # searchValue(mixed $value) : ?array
  # string(string $value) : ?array
  # prep(int $id, string $field, ...) : void
  # fieldCounter()
}

note right of Search::__construct
  Constructor

  since: 3.2.0
end note

note left of Search::get
  Get found values

  since: 3.2.0
  return: ?array
end note

note right of Search::value
  Search inside a value

  since: 3.2.0
  return: bool
  
  arguments:
    mixed $value
    int $id
    string $field
    string $table
end note

note left of Search::reset
  Empty the found values

  since: 3.2.0
  return: void
end note

note right of Search::searchValue
  Search inside a string

  since: 3.2.0
  return: ?array
end note

note left of Search::string
  Search inside a string

  since: 3.2.0
  return: ?array
end note

note right of Search::prep
  Prep the bucket

  since: 3.2.0
  return: void
  
  arguments:
    int $id
    string $field
    string $table
end note

note left of Search::fieldCounter
  we count every field being searched

  since: 3.2.0
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

