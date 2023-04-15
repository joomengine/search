```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# abstract class Engine (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Abstraction**
```uml
@startuml
abstract Engine  #Orange {
  # Config $config
  # ?string $searchValue
  # string $replaceValue
  # int $matchCase
  # int $wholeWord
  # string $start
  # string $end
  + __construct(?Config $config = null)
  # lineCounter()
}

note right of Engine::__construct
  Constructor

  since: 3.2.0
end note

note right of Engine::lineCounter
  we count every line being searched

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

