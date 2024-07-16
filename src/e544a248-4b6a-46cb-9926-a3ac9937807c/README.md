```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Search (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Agent**

```uml
@startuml
class Search  #Gold {
  # array $found
  # Config $config
  # SearchEngine $search
  + __construct(?Config $config = null, ?SearchEngine $search = null)
  + get(string $table) : ?array
  + value(mixed $value, int $id, ...) : bool
  + reset(string $table) : void
  # searchValue(mixed $value) : ?array
  # string(string $value) : ?array
  # prep(int $id, string $field, ...) : void
  # fieldCounter()
}

note right of Search::__construct
  Constructor

  since: 3.2.0
end note

note left of Search::get
  Get found values

  since: 3.2.0
  return: ?array
end note

note right of Search::value
  Search inside a value

  since: 3.2.0
  return: bool
  
  arguments:
    mixed $value
    int $id
    string $field
    string $table
end note

note left of Search::reset
  Empty the found values

  since: 3.2.0
  return: void
end note

note right of Search::searchValue
  Search inside a string

  since: 3.2.0
  return: ?array
end note

note left of Search::string
  Search inside a string

  since: 3.2.0
  return: ?array
end note

note right of Search::prep
  Prep the bucket

  since: 3.2.0
  return: void
  
  arguments:
    int $id
    string $field
    string $table
end note

note left of Search::fieldCounter
  we count every field being searched

  since: 3.2.0
end note
 
@enduml
```

The Power feature in JCB allows you to write PHP classes and their implementations, making it easy to include them in your Joomla project. JCB handles linking, autoloading, namespacing, and folder structure creation for you.

By using the SPK (Super Power Key) in your custom code (replacing the class name in your code with the SPK), JCB will automatically pull the power from the repository into your project. This makes it available in your JCB instance, allowing you to edit it and include the class in your generated Joomla component.

JCB uses placeholders like [[[`NamespacePrefix`]]] and [[[`ComponentNamespace`]]] in namespacing to prevent collisions and improve reusability across different JCB systems. You can also set the **JCB powers path** globally or per component under the **Dynamic Integration** tab, providing flexibility and easy maintainability.

To add this specific Power to your project in JCB:

> simply use this SPK
```
Super---e544a248_4b6a_46cb_9926_a3ac9937807c---Power
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

