```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Database (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Service**
> extends: ****
```uml
@startuml
class Database  #Gold {
  + register(Container $container) : void
  + getLoad(Container $container) : Load
  + getDatabaseLoad(Container $container) : LoadDatabase
  + getDatabaseInsert(Container $container) : InsertDatabase
}

note right of Database::register
  Registers the service provider with a DI container.

  since: 3.2.0
  return: void
end note

note right of Database::getLoad
  Get the Core Load Database

  since: 3.2.0
  return: Load
end note

note right of Database::getDatabaseLoad
  Get the Load Database

  since: 3.2.0
  return: LoadDatabase
end note

note right of Database::getDatabaseInsert
  Get the Insert Database

  since: 3.2.0
  return: InsertDatabase
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

