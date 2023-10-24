```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Basic (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Engine**
> extends: **Engine**
```uml
@startuml
class Basic  #Gold {
  # string $regexValue
  + __construct(?Config $config = null)
  + string(string $value) : ?string
  + replace(string $value) : string
  # replaceWhole(string $value) : string
  # searchWhole(string $value) : ?string
  + match(string $value) : bool
  # searchAll(string $value) : ?string
  # replaceAll(string $value) : string
}

note right of Basic::__construct
  Constructor

  since: 3.2.0
end note

note left of Basic::string
  Search inside a string

  since: 3.2.0
  return: ?string
end note

note right of Basic::replace
  Replace found instances inside string value

  since: 3.2.0
  return: string
end note

note left of Basic::replaceWhole
  Replace whole words

  since: 3.2.0
  return: string
end note

note right of Basic::searchWhole
  Search for whole words

  since: 3.2.0
  return: ?string
end note

note left of Basic::match
  Math the Regular Expression

  since: 3.0.9
  return: bool
end note

note right of Basic::searchAll
  Search for all instances

  since: 3.2.0
  return: ?string
end note

note left of Basic::replaceAll
  Replace for all instances

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

