### JCB! Power
# class Search (Details)
> namespace: **VDM\Joomla\Componentbuilder\Search\Agent**

## Document matching and nested values

The agent uses `DocumentSearchInterface::lines()` when available. Each result
retains its original one-based **starting line**, and its marked snippet may span
several lines. Engines implementing only `SearchTypeInterface` keep their
existing per-line behaviour.

Nested arrays are searched recursively without a fixed depth limit. Only string
leaves are searched, so matches cannot cross separate fields or subform values.
Result keys retain the `array.key.line` format. Literal dots in keys are escaped
as `\.` and literal backslashes as `\\`; for example, key `first.name` on line 2
becomes `first\.name.2`. Numeric key `0` remains a valid path segment.

Searching the same table, item and field again replaces its previous results;
a field that no longer matches has its stale results removed. `resetItem()`
clears one item before a complete rescan so fields removed from that item do
not leave stale results; other items in the table are preserved.

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
  + resetItem(int $id, string $table) : void
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
Super---e544a248_4b6a_46cb_9926_a3ac9937807c---Power
```
> Remember to replace the `---` with `___` to activate this Power in your code.

### Used in [Joomla Component Builder](https://www.joomlacomponentbuilder.com) - [Source](https://git.vdm.dev/joomla/Component-Builder) - [Mirror](https://github.com/vdm-io/Joomla-Component-Builder) - [Download](https://git.vdm.dev/joomla/pkg-component-builder/releases)

---
[![Joomla Volunteer Portal](https://img.shields.io/badge/-Joomla-gold?logo=joomla)](https://volunteers.joomla.org/joomlers/1396-llewellyn-van-der-merwe "Join Llewellyn on the Joomla Volunteer Portal: Shaping the Future Together!") [![GitHub](https://img.shields.io/badge/-Git-181717?logo=git)](https://github.com/joomengine "Build premium Joomla extensions with JoomEngine on GitHub: Help us raise Joomla extension standards!") [![Octoleo](https://img.shields.io/badge/-Octoleo-black?logo=linux)](https://git.vdm.dev/octoleo "--quiet") [![Llewellyn](https://img.shields.io/badge/-Llewellyn-ffffff?logo=gitea)](https://git.vdm.dev/Llewellyn "Collaborate and Innovate with Llewellyn on Git: Building a Better Code Future!") [![Telegram](https://img.shields.io/badge/-Telegram-blue?logo=telegram)](https://t.me/Joomla_component_builder "Join Llewellyn and the Community on Telegram: Building Joomla Components Together!") [![Mastodon](https://img.shields.io/badge/-Mastodon-9e9eec?logo=mastodon)](https://joomla.social/@llewellyn "Connect and Engage with Llewellyn on Joomla Social: Empowering Communities, One Post at a Time!") [![X (Twitter)](https://img.shields.io/badge/-X-black?logo=x)](https://x.com/llewellynvdm "Join the Conversation with Llewellyn on X: Where Ideas Take Flight!") [![GitHub](https://img.shields.io/badge/-GitHub-181717?logo=github)](https://github.com/Llewellynvdm "Build, Innovate, and Thrive with Llewellyn on GitHub: Turning Ideas into Impact!") [![YouTube](https://img.shields.io/badge/-YouTube-ff0000?logo=youtube)](https://www.youtube.com/@OctoYou "Explore, Learn, and Create with Llewellyn on YouTube: Your Gateway to Inspiration!") [![n8n](https://img.shields.io/badge/-n8n-black?logo=n8n)](https://n8n.io/creators/octoleo "Effortless Automation and Impactful Workflows with Llewellyn on n8n!") [![Docker Hub](https://img.shields.io/badge/-Docker-grey?logo=docker)](https://hub.docker.com/r/octoleo/joomengine "JoomEngine on Docker: Containerize Your Creativity!") [![Open Collective](https://img.shields.io/badge/-Donate-green?logo=opencollective)](https://opencollective.com/joomla-component-builder "Donate towards JCB: Help Llewellyn financially so he can continue developing this great tool!") [![GPG Key](https://img.shields.io/badge/-GPG-blue?logo=gnupg)](https://git.vdm.dev/Llewellyn/gpg "Unlock Trust and Security with Llewellyn's GPG Key: Your Gateway to Verified Connections!")