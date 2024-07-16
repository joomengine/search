```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Basic (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Engine**
> extends: **Engine**

```uml
@startuml
class Basic  #Gold {
  # string $regexValue
  + __construct(?Config $config = null)
  + string(string $value) : ?string
  + replace(string $value) : string
  # replaceWhole(string $value) : string
  # searchWhole(string $value) : ?string
  + match(string $value) : bool
  # searchAll(string $value) : ?string
  # replaceAll(string $value) : string
}

note right of Basic::__construct
  Constructor

  since: 3.2.0
end note

note left of Basic::string
  Search inside a string

  since: 3.2.0
  return: ?string
end note

note right of Basic::replace
  Replace found instances inside string value

  since: 3.2.0
  return: string
end note

note left of Basic::replaceWhole
  Replace whole words

  since: 3.2.0
  return: string
end note

note right of Basic::searchWhole
  Search for whole words

  since: 3.2.0
  return: ?string
end note

note left of Basic::match
  Math the Regular Expression

  since: 3.0.9
  return: bool
end note

note right of Basic::searchAll
  Search for all instances

  since: 3.2.0
  return: ?string
end note

note left of Basic::replaceAll
  Replace for all instances

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
Super---db093eca_63b3_4d6c_9232_3ceb058121c0---Power
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

