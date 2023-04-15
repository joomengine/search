```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# abstract class Factory (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search**
```uml
@startuml
abstract Factory  #Orange {
  # static $container
  + {static} _(string $key) : Mixed
  + {static} getContainer() : Container
  # {static} createContainer() : Container
}

note right of Factory::_
  Get any class from the search container

  since: 3.2.0
  return: Mixed
end note

note right of Factory::getContainer
  Get the global search container

  since: 3.2.0
  return: Container
end note

note right of Factory::createContainer
  Create a container object

  since: 3.2.0
  return: Container
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

