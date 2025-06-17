### JCB! Power
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

The **Power** feature in JCB allows you to write PHP classes and their implementations,
making it easy to include them in your Joomla project. JCB handles linking, autoloading,
namespacing, and folder structure creation for you.

By using the **SPK** (Super Power Key) in your custom code (replacing the class name
in your code with the SPK), JCB will automatically pull the Power from the repository
into your project. This makes it available in your JCB instance, allowing you to edit
and include the class in your generated Joomla component.

JCB uses placeholders like [[[`NamespacePrefix`]]] and [[[`ComponentNamespace`]]] in
namespacing to prevent collisions and improve reusability across different JCB systems.

You can also set the **JCB powers path** globally or per component under the
**Dynamic Integration** tab, providing flexibility and maintainability.

To add this specific Power to your project in JCB:

> Simply use this SPK:
```
Super---0b658434_3767_401e_addc_eabfd1d0e94a---Power
```
> Remember to replace the `---` with `___` to activate this Power in your code.

### Used in [Joomla Component Builder](https://www.joomlacomponentbuilder.com) - [Source](https://git.vdm.dev/joomla/Component-Builder) - [Mirror](https://github.com/vdm-io/Joomla-Component-Builder) - [Download](https://git.vdm.dev/joomla/pkg-component-builder/releases)

---
[![Joomla Volunteer Portal](https://img.shields.io/badge/-Joomla-gold?logo=joomla)](https://volunteers.joomla.org/joomlers/1396-llewellyn-van-der-merwe "Join Llewellyn on the Joomla Volunteer Portal: Shaping the Future Together!") [![Octoleo](https://img.shields.io/badge/-Octoleo-black?logo=linux)](https://git.vdm.dev/octoleo "--quiet") [![Llewellyn](https://img.shields.io/badge/-Llewellyn-ffffff?logo=gitea)](https://git.vdm.dev/Llewellyn "Collaborate and Innovate with Llewellyn on Git: Building a Better Code Future!") [![Telegram](https://img.shields.io/badge/-Telegram-blue?logo=telegram)](https://t.me/Joomla_component_builder "Join Llewellyn and the Community on Telegram: Building Joomla Components Together!") [![Mastodon](https://img.shields.io/badge/-Mastodon-9e9eec?logo=mastodon)](https://joomla.social/@llewellyn "Connect and Engage with Llewellyn on Joomla Social: Empowering Communities, One Post at a Time!") [![X (Twitter)](https://img.shields.io/badge/-X-black?logo=x)](https://x.com/llewellynvdm "Join the Conversation with Llewellyn on X: Where Ideas Take Flight!") [![GitHub](https://img.shields.io/badge/-GitHub-181717?logo=github)](https://github.com/Llewellynvdm "Build, Innovate, and Thrive with Llewellyn on GitHub: Turning Ideas into Impact!") [![YouTube](https://img.shields.io/badge/-YouTube-ff0000?logo=youtube)](https://www.youtube.com/@OctoYou "Explore, Learn, and Create with Llewellyn on YouTube: Your Gateway to Inspiration!") [![n8n](https://img.shields.io/badge/-n8n-black?logo=n8n)](https://n8n.io/creators/octoleo "Effortless Automation and Impactful Workflows with Llewellyn on n8n!") [![Docker Hub](https://img.shields.io/badge/-Docker-grey?logo=docker)](https://hub.docker.com/u/llewellyn "Llewellyn on Docker: Containerize Your Creativity!") [![Open Collective](https://img.shields.io/badge/-Donate-green?logo=opencollective)](https://opencollective.com/joomla-component-builder "Donate towards JCB: Help Llewellyn financially so he can continue developing this great tool!") [![GPG Key](https://img.shields.io/badge/-GPG-blue?logo=gnupg)](https://git.vdm.dev/Llewellyn/gpg "Unlock Trust and Security with Llewellyn's GPG Key: Your Gateway to Verified Connections!")