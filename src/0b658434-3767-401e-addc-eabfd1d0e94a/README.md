```
██████╗  ██████╗ ██╗    ██╗███████╗██████╗
██╔══██╗██╔═══██╗██║    ██║██╔════╝██╔══██╗
██████╔╝██║   ██║██║ █╗ ██║█████╗  ██████╔╝
██╔═══╝ ██║   ██║██║███╗██║██╔══╝  ██╔══██╗
██║     ╚██████╔╝╚███╔███╔╝███████╗██║  ██║
╚═╝      ╚═════╝  ╚══╝╚══╝ ╚══════╝╚═╝  ╚═╝
```
# class Agent (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search**

```uml
@startuml
class Agent  #Gold {
  # Config $config
  # Load $load
  # Insert $insert
  # Find $find
  # Replace $replace
  # Search $search
  # Update $update
  # Table $table
  # string $return
  # array $marker
  # array $markerHtml
  + __construct(?Config $config = null, ?Load $load = null, ...)
  + getValue(int $id, string $field, ...) : ?string
  + setValue(mixed $value, int $id, ...) : bool
  + table(?string $table = null) : ?array
  + find(?string $table = null) : ?array
  + replace(?string $table = null) : int
  # getRow(string $code, string $table, ...) : array
  # getRowCode(string $code) : string
  # getRowEditButton(string $view, string $field, ...) : string
  # setReturnValue() : void
  # setMarkers() : void
}

note right of Agent::__construct
  Constructor

  since: 3.2.0
  
  arguments:
    ?Config $config = null
    ?Load $load = null
    ?Insert $insert = null
    ?Find $find = null
    ?Replace $replace = null
    ?Search $search = null
    ?Update $update = null
    ?Table $table = null
end note

note left of Agent::getValue
  Get the value of a field in a row and table

  since: 3.2.0
  return: ?string
  
  arguments:
    int $id
    string $field
    mixed $line = null
    ?string $table = null
    bool $update = false
end note

note right of Agent::setValue
  Set the value of a field in a row and table

  since: 3.2.0
  return: bool
  
  arguments:
    mixed $value
    int $id
    string $field
    ?string $table = null
end note

note left of Agent::table
  Return Table Ready Search Results

  since: 3.2.0
  return: ?array
end note

note right of Agent::find
  Search the posted table for the search value and return all

  since: 3.2.0
  return: ?array
end note

note left of Agent::replace
  Search the posted table for the search value, and replace all

  since: 3.2.0
  return: int
end note

note right of Agent::getRow
  Return prepared code string for table

  since: 3.2.0
  return: array
  
  arguments:
    string $code
    string $table
    string $field
    int $id
    mixed $line
end note

note left of Agent::getRowCode
  Return prepared code string for table

  since: 3.2.0
  return: string
end note

note right of Agent::getRowEditButton
  Get the Item button to edit an item

  since: 3.2.0
  return: string
  
  arguments:
    string $view
    string $field
    int $id
    mixed $line
end note

note left of Agent::setReturnValue
  Set the return value for this search

  since: 3.2.0
  return: void
end note

note right of Agent::setMarkers
  Set the markers of the found code

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
Super---0b658434_3767_401e_addc_eabfd1d0e94a---Power
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

