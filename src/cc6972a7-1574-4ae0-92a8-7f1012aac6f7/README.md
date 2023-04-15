```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Agent (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Service**
```uml
@startuml
class Agent  #Gold {
  + register(Container $container) : void
  + getAgent(Container $container) : SearchAgent
  + getFind(Container $container) : Find
  + getReplace(Container $container) : Replace
  + getSearch(Container $container) : Search
  + getUpdate(Container $container) : Update
}

note right of Agent::register
  Registers the service provider with a DI container.

  since: 3.2.0
  return: void
end note

note right of Agent::getAgent
  Get the Search Agent

  since: 3.2.0
  return: SearchAgent
end note

note right of Agent::getFind
  Get the Search Agent Find

  since: 3.2.0
  return: Find
end note

note right of Agent::getReplace
  Get the Search Agent Replace

  since: 3.2.0
  return: Replace
end note

note right of Agent::getSearch
  Get the Search Agent Search

  since: 3.2.0
  return: Search
end note

note right of Agent::getUpdate
  Get the Search Agent Update

  since: 3.2.0
  return: Update
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

