```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Config (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search**
```uml
@startuml
class Config  #Gold {
  # getTypesearch() : ?int
  # getSearchvalue() : ?string
  # getReplacevalue() : string
  # getMatchcase() : int
  # getWholeword() : int
  # getRegexsearch() : int
  # getComponentid() : int
  # getTablename() : ?string
  # getFieldname() : ?string
  # getItemid() : int
  # getFieldcounter() : int
  # getLinecounter() : int
  # getMarkerstart() : string
  # getMarkerend() : string
}

note right of Config::getTypesearch
  get type search being preformed

  since: 3.2.0
  return: ?int
end note

note left of Config::getSearchvalue
  get posted search value

  since: 3.2.0
  return: ?string
end note

note right of Config::getReplacevalue
  get posted replace value

  since: 3.2.0
  return: string
end note

note left of Config::getMatchcase
  get posted search match case

  since: 3.2.0
  return: int
end note

note right of Config::getWholeword
  get posted search whole word

  since: 3.2.0
  return: int
end note

note left of Config::getRegexsearch
  get posted search regex

  since: 3.2.0
  return: int
end note

note right of Config::getComponentid
  get posted component

  since: 3.2.0
  return: int
end note

note left of Config::getTablename
  get posted area/table

  since: 3.2.0
  return: ?string
end note

note right of Config::getFieldname
  get posted field

  since: 3.2.0
  return: ?string
end note

note left of Config::getItemid
  get posted item id

  since: 3.2.0
  return: int
end note

note right of Config::getFieldcounter
  get field counter

  since: 3.2.0
  return: int
end note

note left of Config::getLinecounter
  get line counter

  since: 3.2.0
  return: int
end note

note right of Config::getMarkerstart
  get the start marker

  since: 3.2.0
  return: string
end note

note left of Config::getMarkerend
  get the end marker

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

