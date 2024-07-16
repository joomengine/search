```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# interface FindInterface (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Interfaces**

```uml
@startuml
interface FindInterface  #Lavender {
  + get(?string $table = null) : ?array
  + item(object $item, ?int $id = null, ...) : void
  + items(?array $items = null, ?string $table = null) : void
  + reset(?string $table = null) : void
}

note right of FindInterface::get
  Get found values

  since: 3.2.0
  return: ?array
end note

note right of FindInterface::item
  Search over an item fields

  since: 3.2.0
  return: void
  
  arguments:
    object $item
    ?int $id = null
    ?string $table = null
end note

note right of FindInterface::items
  Search over an array of items

  since: 3.2.0
  return: void
end note

note right of FindInterface::reset
  Reset all found values of a table

  since: 3.2.0
  return: void
end note
 
@enduml
```

The Power feature in JCB allows you to write PHP classes and their implementations, making it easy to include them in your Joomla project. JCB handles linking, autoloading, namespacing, and folder structure creation for you.

By using the SPK (Super Power Key) in your custom code (replacing the class name in your code with the SPK), JCB will automatically pull the power from the repository into your project. This makes it available in your JCB instance, allowing you to edit it and include the class in your generated Joomla component.

JCB uses placeholders like [[[`NamespacePrefix`]]] and [[[`ComponentNamespace`]]] in namespacing to prevent collisions and improve reusability across different JCB systems. You can also set the **JCB powers path** globally or per component under the **Dynamic Integration** tab, providing flexibility and easy maintainability.

To add this specific Power to your project in JCB:

> simply use this SPK
```
Super---55280ec7_e48d_431b_af25_10308dd30636---Power
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

