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

The Power feature in JCB allows you to write PHP classes and their implementations, making it easy to include them in your Joomla project. JCB handles linking, autoloading, namespacing, and folder structure creation for you.

By using the SPK (Super Power Key) in your custom code (replacing the class name in your code with the SPK), JCB will automatically pull the power from the repository into your project. This makes it available in your JCB instance, allowing you to edit it and include the class in your generated Joomla component.

JCB uses placeholders like [[[`NamespacePrefix`]]] and [[[`ComponentNamespace`]]] in namespacing to prevent collisions and improve reusability across different JCB systems. You can also set the **JCB powers path** globally or per component under the **Dynamic Integration** tab, providing flexibility and easy maintainability.

To add this specific Power to your project in JCB:

> simply use this SPK
```
Super---cc6972a7_1574_4ae0_92a8_7f1012aac6f7---Power
```
> remember to replace the `---` with `___` to activate this Power in your code

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

