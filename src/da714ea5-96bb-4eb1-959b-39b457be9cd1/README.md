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

The Power feature in JCB allows you to write PHP classes and their implementations, making it easy to include them in your Joomla project. JCB handles linking, autoloading, namespacing, and folder structure creation for you.

By using the SPK (Super Power Key) in your custom code (replacing the class name in your code with the SPK), JCB will automatically pull the power from the repository into your project. This makes it available in your JCB instance, allowing you to edit it and include the class in your generated Joomla component.

JCB uses placeholders like [[[`NamespacePrefix`]]] and [[[`ComponentNamespace`]]] in namespacing to prevent collisions and improve reusability across different JCB systems. You can also set the **JCB powers path** globally or per component under the **Dynamic Integration** tab, providing flexibility and easy maintainability.

To add this specific Power to your project in JCB:

> simply use this SPK
```
Super---da714ea5_96bb_4eb1_959b_39b457be9cd1---Power
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

