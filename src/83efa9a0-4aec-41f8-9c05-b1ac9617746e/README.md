```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Regex (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Engine**
> extends: **Engine**
```uml
@startuml
class Regex  #Gold {
  # string $regexValue
  + __construct(?Config $config = null)
  + string(string $value) : ?string
  + replace(string $value) : string
  + match(string $value) : bool
}

note right of Regex::__construct
  Constructor

  since: 3.2.0
end note

note right of Regex::string
  Search inside a string

  since: 3.2.0
  return: ?string
end note

note right of Regex::replace
  Replace found instances inside string value

  since: 3.2.0
  return: string
end note

note right of Regex::match
  Math the Regular Expression

  since: 3.0.9
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

