```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Load (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Model**
> extends: **Model**

```uml
@startuml
class Load  #Gold {
  # Config $config
  + __construct(?Config $config = null, ?Table $table = null)
  + value(mixed $value, string $field, ...) : mixed
  # validateBefore(mixed $value, ?string $field = null, ...) : bool
  # validateAfter(mixed $value, ?string $field = null, ...) : bool
  # getTable() : string
}

note right of Load::__construct
  Constructor

  since: 3.2.0
end note

note right of Load::value
  Model the value
Example: $this->value(value, 'value_key', 'table_name');

  since: 3.2.0
  return: mixed
  
  arguments:
    mixed $value
    string $field
    ?string $table = null
end note

note right of Load::validateBefore
  Validate before the value is modelled (basic, override in child class)

  since: 3.2.0
  return: bool
  
  arguments:
    mixed $value
    ?string $field = null
    ?string $table = null
end note

note right of Load::validateAfter
  Validate after the value is modelled (basic, override in child class)

  since: 3.2.0
  return: bool
  
  arguments:
    mixed $value
    ?string $field = null
    ?string $table = null
end note

note right of Load::getTable
  Get the current active table

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
Super---f523ab49_907a_4356_b064_51c85a187fbd---Power
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

