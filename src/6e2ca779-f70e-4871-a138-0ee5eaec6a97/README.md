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
> extends: **BaseConfig**

```uml
@startuml
class Config  #Gold {
  # Input $input
  + __construct(?Input $input = null)
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

note right of Config::__construct
  Constructor

  since: 3.2.0
end note

note left of Config::getTypesearch
  get type search being preformed

  since: 3.2.0
  return: ?int
end note

note right of Config::getSearchvalue
  get posted search value

  since: 3.2.0
  return: ?string
end note

note left of Config::getReplacevalue
  get posted replace value

  since: 3.2.0
  return: string
end note

note right of Config::getMatchcase
  get posted search match case

  since: 3.2.0
  return: int
end note

note left of Config::getWholeword
  get posted search whole word

  since: 3.2.0
  return: int
end note

note right of Config::getRegexsearch
  get posted search regex

  since: 3.2.0
  return: int
end note

note left of Config::getComponentid
  get posted component

  since: 3.2.0
  return: int
end note

note right of Config::getTablename
  get posted area/table

  since: 3.2.0
  return: ?string
end note

note left of Config::getFieldname
  get posted field

  since: 3.2.0
  return: ?string
end note

note right of Config::getItemid
  get posted item id

  since: 3.2.0
  return: int
end note

note left of Config::getFieldcounter
  get field counter

  since: 3.2.0
  return: int
end note

note right of Config::getLinecounter
  get line counter

  since: 3.2.0
  return: int
end note

note left of Config::getMarkerstart
  get the start marker

  since: 3.2.0
  return: string
end note

note right of Config::getMarkerend
  get the end marker

  since: 3.2.0
  return: string
end note
 
@enduml
```

The Power feature in JCB allows you to write PHP classes and their implementations, making it easy to include them in your Joomla project. JCB handles linking, autoloading, namespacing, and folder structure creation for you.

By using the SPK (Super Power Key) in your custom code (replacing the class name in your code with the SPK), JCB will automatically pull the power from the repository into your project. This makes it available in your JCB instance, allowing you to edit it and include the class in your generated Joomla component.

JCB uses placeholders like [[[`NamespacePrefix`]]] and [[[`ComponentNamespace`]]] in namespacing to prevent collisions and improve reusability across different JCB systems. You can also set the **JCB powers path** globally or per component under the **Dynamic Integration** tab, providing flexibility and easy maintainability.

To add this specific Power to your project in JCB:

> simply use this SPK
```
Super---6e2ca779_f70e_4871_a138_0ee5eaec6a97---Power
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

