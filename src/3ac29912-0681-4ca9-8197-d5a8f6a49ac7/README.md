```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Update (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Agent**

```uml
@startuml
class Update  #Gold {
  # SearchEngine $search
  + __construct(?SearchEngine $search = null)
  + value(mixed $value, mixed $line) : mixed
  # updateValue(mixed $value, mixed $line) : mixed
  # validateUpdateKey(int $line, mixed $keys = null, ...) : bool
  # string(string $value, int $line) : string
}

note right of Update::__construct
  Constructor

  since: 3.2.0
end note

note right of Update::value
  Update the value

  since: 3.2.0
  return: mixed
end note

note right of Update::updateValue
  Update all search-replace instances inside a value

  since: 3.2.0
  return: mixed
end note

note right of Update::validateUpdateKey
  Check if the keys are valid for search when working with arrays

  since: 3.2.0
  return: bool
  
  arguments:
    int $line
    mixed $keys = null
    mixed $key = null
    $ke = null
    mixed $k = null
end note

note right of Update::string
  Update all search-replace instances inside a string

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
Super---3ac29912_0681_4ca9_8197_d5a8f6a49ac7---Power
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

