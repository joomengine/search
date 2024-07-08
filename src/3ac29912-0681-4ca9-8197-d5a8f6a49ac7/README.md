```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Update (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Agent**
> extends: ****
```uml
@startuml
class Update  #Gold {
  # SearchEngine $search
  + __construct(?SearchEngine $search = null)
  + value(mixed $value, mixed $line) : mixed
  # updateValue(mixed $value, mixed $line) : mixed
  # validateUpdateKey(int $line, mixed $keys = null, ...) : bool
  # string(string $value, int $line) : string
}

note right of Update::__construct
  Constructor

  since: 3.2.0
end note

note right of Update::value
  Update the value

  since: 3.2.0
  return: mixed
end note

note right of Update::updateValue
  Update all search-replace instances inside a value

  since: 3.2.0
  return: mixed
end note

note right of Update::validateUpdateKey
  Check if the keys are valid for search when working with arrays

  since: 3.2.0
  return: bool
  
  arguments:
    int $line
    mixed $keys = null
    mixed $key = null
    $ke = null
    mixed $k = null
end note

note right of Update::string
  Update all search-replace instances inside a string

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

