```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Search (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Service**
> extends: ****
```uml
@startuml
class Search  #Gold {
  # $searchEngine
  + register(Container $container) : void
  + getConfig(Container $container) : Config
  + getTable(Container $container) : Table
  + getRegex(Container $container) : Regex
  + getBasic(Container $container) : Basic
  + getSearch(Container $container) : SearchEngine
}

note right of Search::register
  Registers the service provider with a DI container.

  since: 3.2.0
  return: void
end note

note right of Search::getConfig
  Get the Config

  since: 3.2.0
  return: Config
end note

note right of Search::getTable
  Get the Table

  since: 3.2.0
  return: Table
end note

note right of Search::getRegex
  Get the Regex Type Search Engine

  since: 3.2.0
  return: Regex
end note

note right of Search::getBasic
  Get the Basic Type Search Engine

  since: 3.2.0
  return: Basic
end note

note right of Search::getSearch
  Get the Search Engine

  since: 3.2.0
  return: SearchEngine
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

