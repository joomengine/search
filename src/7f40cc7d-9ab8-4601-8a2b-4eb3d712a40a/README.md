```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Model (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Service**
> extends: ****
```uml
@startuml
class Model  #Gold {
  + register(Container $container) : void
  + getModelLoad(Container $container) : Load
  + getModelInsert(Container $container) : Insert
}

note right of Model::register
  Registers the service provider with a DI container.

  since: 3.2.0
  return: void
end note

note right of Model::getModelLoad
  Get the Load Model

  since: 3.2.0
  return: Load
end note

note right of Model::getModelInsert
  Get the Insert Model

  since: 3.2.0
  return: Insert
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

