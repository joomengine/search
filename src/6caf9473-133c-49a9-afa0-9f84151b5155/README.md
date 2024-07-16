```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Insert (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Database**

```uml
@startuml
class Insert  #Gold {
  # Config $config
  # Table $table
  # Model $model
  # $db
  + __construct(?Config $config = null, ?Table $table = null, ...)
  + value(mixed $value, int $id, ...) : bool
  + item(object $item, ?string $table = null) : bool
  + items(?array $items, string $table = null) : bool
}

note right of Insert::__construct
  Constructor

  since: 3.2.0
  
  arguments:
    ?Config $config = null
    ?Table $table = null
    ?Model $model = null
end note

note right of Insert::value
  Set values to a given table
Example: $this->value(Value, 23, 'value_key', 'table_name');

  since: 3.2.0
  return: bool
  
  arguments:
    mixed $value
    int $id
    string $field
    ?string $table = null
end note

note right of Insert::item
  Set values to a given table
Example: $this->item(Object, 'table_name');

  since: 3.2.0
  return: bool
end note

note right of Insert::items
  Set values to a given table
Example: $this->items(Array, 'table_name');

  since: 3.2.0
  return: bool
end note
 
@enduml
```

The Power feature in JCB allows you to write PHP classes and their implementations, making it easy to include them in your Joomla project. JCB handles linking, autoloading, namespacing, and folder structure creation for you.

By using the SPK (Super Power Key) in your custom code (replacing the class name in your code with the SPK), JCB will automatically pull the power from the repository into your project. This makes it available in your JCB instance, allowing you to edit it and include the class in your generated Joomla component.

JCB uses placeholders like [[[`NamespacePrefix`]]] and [[[`ComponentNamespace`]]] in namespacing to prevent collisions and improve reusability across different JCB systems. You can also set the **JCB powers path** globally or per component under the **Dynamic Integration** tab, providing flexibility and easy maintainability.

To add this specific Power to your project in JCB:

> simply use this SPK
```
Super---6caf9473_133c_49a9_afa0_9f84151b5155---Power
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

