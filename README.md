# JCB! Super Powers

### What Are JCB Super Powers?
In simple terms, **JCB Super Powers are PHP classes** — but managed entirely from the Joomla Component Builder (JCB) interface.

You can use JCB to create your own:
- **Classes**
- **Interfaces**
- **Abstract classes**
- **Traits**
- **Final classes**

These are full-featured PHP code units that you define visually in the JCB GUI. JCB then takes care of:
- Proper **namespacing**
- Correct **file placement**
- Seamless **project integration**

Every Super Power is treated as a reusable unit of logic. It can be automatically injected into any part of your JCB-powered component, or used in other components or codebases via a **SPK** (Super Power Key).

Even better — you can use **dynamic placeholders** like [[[`NamespacePrefix`]]] or [[[`ComponentNamespace`]]] in your Super Power code Namespace. These automatically adapt when reused in different projects, making your logic portable and future-proof.

> In short: **Super Powers turn JCB into a PHP code factory** — giving you the power of advanced PHP with none of the manual file management.

To learn how to create, manage, and use Super Powers, see the  
[Super Powers Documentation →](https://git.vdm.dev/joomla/super-powers/wiki)

### What Can I Find Here?
This repository acts as a **central registry of approved Super Powers** specific to this JCB instance.  
Only the Super Powers that have been explicitly assigned to this repository are listed here.

In JCB, you can organize your Super Powers across multiple repositories.  
For example, we have separate repositories for:

- [GITEA](https://git.vdm.dev/joomla/gitea)-related classes
- [OpenAI](https://git.vdm.dev/joomla/openai) integrations
- Core [Super Power](https://git.vdm.dev/joomla/super-powers) collection
- and many more...

Each repository maintains its own index, and only the powers assigned to that specific repository will appear in its list.
#### How to Use These Super Powers
If you want to use any of the classes listed here in your own component logic, simply reference their **SPK** (Super Power Key):

```
Super---[unique-guid]---Power
```

> Replace each `---` with `___` when using the key inside your code.

JCB will automatically resolve this SPK during compilation, placing the associated class in the correct location with the correct namespace based on your component context.  
This makes your logic both **reusable** and **component-aware**, without hardcoding anything.

---
# Index of powers

- **Namespace**: [VDM\Joomla\Componentbuilder\Search](#vdm-joomla-componentbuilder-search)

  - **abstract class Factory** | [Details](src/01a89ba8-f8bb-435c-93de-0a8f3fa9432a) | [Raw](src/01a89ba8-f8bb-435c-93de-0a8f3fa9432a/code.power) | [Settings](src/01a89ba8-f8bb-435c-93de-0a8f3fa9432a/settings.json) | SPK: `Super---01a89ba8_f8bb_435c_93de_0a8f3fa9432a---Power`
  - **class Agent** | [Details](src/0b658434-3767-401e-addc-eabfd1d0e94a) | [Raw](src/0b658434-3767-401e-addc-eabfd1d0e94a/code.power) | [Settings](src/0b658434-3767-401e-addc-eabfd1d0e94a/settings.json) | SPK: `Super---0b658434_3767_401e_addc_eabfd1d0e94a---Power`
  - **class Config** | [Details](src/6e2ca779-f70e-4871-a138-0ee5eaec6a97) | [Raw](src/6e2ca779-f70e-4871-a138-0ee5eaec6a97/code.power) | [Settings](src/6e2ca779-f70e-4871-a138-0ee5eaec6a97/settings.json) | SPK: `Super---6e2ca779_f70e_4871_a138_0ee5eaec6a97---Power`
- **Namespace**: [VDM\Joomla\Componentbuilder\Search\Abstraction](#vdm-joomla-componentbuilder-search-abstraction)

  - **abstract class Engine** | [Details](src/8f9449fc-bfbc-49a5-b146-d58c8c17dfdf) | [Raw](src/8f9449fc-bfbc-49a5-b146-d58c8c17dfdf/code.power) | [Settings](src/8f9449fc-bfbc-49a5-b146-d58c8c17dfdf/settings.json) | SPK: `Super---8f9449fc_bfbc_49a5_b146_d58c8c17dfdf---Power`
- **Namespace**: [VDM\Joomla\Componentbuilder\Search\Agent](#vdm-joomla-componentbuilder-search-agent)

  - **class Find** | [Details](src/15d9e1a9-3364-4d69-9d9f-9b87db820e5c) | [Raw](src/15d9e1a9-3364-4d69-9d9f-9b87db820e5c/code.power) | [Settings](src/15d9e1a9-3364-4d69-9d9f-9b87db820e5c/settings.json) | SPK: `Super---15d9e1a9_3364_4d69_9d9f_9b87db820e5c---Power`
  - **class Replace** | [Details](src/abc37ddd-1ff5-4204-9e5b-015ab4f3d4c7) | [Raw](src/abc37ddd-1ff5-4204-9e5b-015ab4f3d4c7/code.power) | [Settings](src/abc37ddd-1ff5-4204-9e5b-015ab4f3d4c7/settings.json) | SPK: `Super---abc37ddd_1ff5_4204_9e5b_015ab4f3d4c7---Power`
  - **class Search** | [Details](src/e544a248-4b6a-46cb-9926-a3ac9937807c) | [Raw](src/e544a248-4b6a-46cb-9926-a3ac9937807c/code.power) | [Settings](src/e544a248-4b6a-46cb-9926-a3ac9937807c/settings.json) | SPK: `Super---e544a248_4b6a_46cb_9926_a3ac9937807c---Power`
  - **class Update** | [Details](src/3ac29912-0681-4ca9-8197-d5a8f6a49ac7) | [Raw](src/3ac29912-0681-4ca9-8197-d5a8f6a49ac7/code.power) | [Settings](src/3ac29912-0681-4ca9-8197-d5a8f6a49ac7/settings.json) | SPK: `Super---3ac29912_0681_4ca9_8197_d5a8f6a49ac7---Power`
- **Namespace**: [VDM\Joomla\Componentbuilder\Search\Database](#vdm-joomla-componentbuilder-search-database)

  - **class Insert** | [Details](src/6caf9473-133c-49a9-afa0-9f84151b5155) | [Raw](src/6caf9473-133c-49a9-afa0-9f84151b5155/code.power) | [Settings](src/6caf9473-133c-49a9-afa0-9f84151b5155/settings.json) | SPK: `Super---6caf9473_133c_49a9_afa0_9f84151b5155---Power`
  - **class Load** | [Details](src/2dabfb4a-64cd-4c04-9772-4a75f9f3b710) | [Raw](src/2dabfb4a-64cd-4c04-9772-4a75f9f3b710/code.power) | [Settings](src/2dabfb4a-64cd-4c04-9772-4a75f9f3b710/settings.json) | SPK: `Super---2dabfb4a_64cd_4c04_9772_4a75f9f3b710---Power`
- **Namespace**: [VDM\Joomla\Componentbuilder\Search\Engine](#vdm-joomla-componentbuilder-search-engine)

  - **class Basic** | [Details](src/db093eca-63b3-4d6c-9232-3ceb058121c0) | [Raw](src/db093eca-63b3-4d6c-9232-3ceb058121c0/code.power) | [Settings](src/db093eca-63b3-4d6c-9232-3ceb058121c0/settings.json) | SPK: `Super---db093eca_63b3_4d6c_9232_3ceb058121c0---Power`
  - **class Regex** | [Details](src/83efa9a0-4aec-41f8-9c05-b1ac9617746e) | [Raw](src/83efa9a0-4aec-41f8-9c05-b1ac9617746e/code.power) | [Settings](src/83efa9a0-4aec-41f8-9c05-b1ac9617746e/settings.json) | SPK: `Super---83efa9a0_4aec_41f8_9c05_b1ac9617746e---Power`
- **Namespace**: [VDM\Joomla\Componentbuilder\Search\Interfaces](#vdm-joomla-componentbuilder-search-interfaces)

  - **interface FindInterface** | [Details](src/55280ec7-e48d-431b-af25-10308dd30636) | [Raw](src/55280ec7-e48d-431b-af25-10308dd30636/code.power) | [Settings](src/55280ec7-e48d-431b-af25-10308dd30636/settings.json) | SPK: `Super---55280ec7_e48d_431b_af25_10308dd30636---Power`
  - **interface InsertInterface** | [Details](src/4c44e5d3-750c-4609-88c8-aa441838b8fe) | [Raw](src/4c44e5d3-750c-4609-88c8-aa441838b8fe/code.power) | [Settings](src/4c44e5d3-750c-4609-88c8-aa441838b8fe/settings.json) | SPK: `Super---4c44e5d3_750c_4609_88c8_aa441838b8fe---Power`
  - **interface LoadInterface** | [Details](src/2bd1a32c-3d90-4646-9314-28d44d164f76) | [Raw](src/2bd1a32c-3d90-4646-9314-28d44d164f76/code.power) | [Settings](src/2bd1a32c-3d90-4646-9314-28d44d164f76/settings.json) | SPK: `Super---2bd1a32c_3d90_4646_9314_28d44d164f76---Power`
  - **interface ReplaceInterface** | [Details](src/afdae35d-fe7f-4055-99ea-afd8ff8349b6) | [Raw](src/afdae35d-fe7f-4055-99ea-afd8ff8349b6/code.power) | [Settings](src/afdae35d-fe7f-4055-99ea-afd8ff8349b6/settings.json) | SPK: `Super---afdae35d_fe7f_4055_99ea_afd8ff8349b6---Power`
  - **interface SearchInterface** | [Details](src/0d9442ab-54d9-4947-a219-244cfaea3084) | [Raw](src/0d9442ab-54d9-4947-a219-244cfaea3084/code.power) | [Settings](src/0d9442ab-54d9-4947-a219-244cfaea3084/settings.json) | SPK: `Super---0d9442ab_54d9_4947_a219_244cfaea3084---Power`
  - **interface SearchTypeInterface** | [Details](src/117d8c9e-3f8d-40ae-b375-1efa2fe5538a) | [Raw](src/117d8c9e-3f8d-40ae-b375-1efa2fe5538a/code.power) | [Settings](src/117d8c9e-3f8d-40ae-b375-1efa2fe5538a/settings.json) | SPK: `Super---117d8c9e_3f8d_40ae_b375_1efa2fe5538a---Power`
- **Namespace**: [VDM\Joomla\Componentbuilder\Search\Model](#vdm-joomla-componentbuilder-search-model)

  - **class Insert** | [Details](src/02efe40a-7792-4c82-9444-7d0377243483) | [Raw](src/02efe40a-7792-4c82-9444-7d0377243483/code.power) | [Settings](src/02efe40a-7792-4c82-9444-7d0377243483/settings.json) | SPK: `Super---02efe40a_7792_4c82_9444_7d0377243483---Power`
  - **class Load** | [Details](src/f523ab49-907a-4356-b064-51c85a187fbd) | [Raw](src/f523ab49-907a-4356-b064-51c85a187fbd/code.power) | [Settings](src/f523ab49-907a-4356-b064-51c85a187fbd/settings.json) | SPK: `Super---f523ab49_907a_4356_b064_51c85a187fbd---Power`
- **Namespace**: [VDM\Joomla\Componentbuilder\Search\Service](#vdm-joomla-componentbuilder-search-service)

  - **class Agent** | [Details](src/cc6972a7-1574-4ae0-92a8-7f1012aac6f7) | [Raw](src/cc6972a7-1574-4ae0-92a8-7f1012aac6f7/code.power) | [Settings](src/cc6972a7-1574-4ae0-92a8-7f1012aac6f7/settings.json) | SPK: `Super---cc6972a7_1574_4ae0_92a8_7f1012aac6f7---Power`
  - **class Database** | [Details](src/d5de47ce-9a9e-4e76-a5c6-61ed74842ea3) | [Raw](src/d5de47ce-9a9e-4e76-a5c6-61ed74842ea3/code.power) | [Settings](src/d5de47ce-9a9e-4e76-a5c6-61ed74842ea3/settings.json) | SPK: `Super---d5de47ce_9a9e_4e76_a5c6_61ed74842ea3---Power`
  - **class Model** | [Details](src/7f40cc7d-9ab8-4601-8a2b-4eb3d712a40a) | [Raw](src/7f40cc7d-9ab8-4601-8a2b-4eb3d712a40a/code.power) | [Settings](src/7f40cc7d-9ab8-4601-8a2b-4eb3d712a40a/settings.json) | SPK: `Super---7f40cc7d_9ab8_4601_8a2b_4eb3d712a40a---Power`
  - **class Search** | [Details](src/da714ea5-96bb-4eb1-959b-39b457be9cd1) | [Raw](src/da714ea5-96bb-4eb1-959b-39b457be9cd1/code.power) | [Settings](src/da714ea5-96bb-4eb1-959b-39b457be9cd1/settings.json) | SPK: `Super---da714ea5_96bb_4eb1_959b_39b457be9cd1---Power`
> remember to replace the `---` with `___` in the SPK to activate that Power in your code

### All used in [Joomla Component Builder](https://www.joomlacomponentbuilder.com) - [Source](https://git.vdm.dev/joomla/Component-Builder) - [Mirror](https://github.com/vdm-io/Joomla-Component-Builder) - [Download](https://git.vdm.dev/joomla/pkg-component-builder/releases)

---
[![Joomla Volunteer Portal](https://img.shields.io/badge/-Joomla-gold?logo=joomla)](https://volunteers.joomla.org/joomlers/1396-llewellyn-van-der-merwe "Join Llewellyn on the Joomla Volunteer Portal: Shaping the Future Together!") [![Octoleo](https://img.shields.io/badge/-Octoleo-black?logo=linux)](https://git.vdm.dev/octoleo "--quiet") [![Llewellyn](https://img.shields.io/badge/-Llewellyn-ffffff?logo=gitea)](https://git.vdm.dev/Llewellyn "Collaborate and Innovate with Llewellyn on Git: Building a Better Code Future!") [![Telegram](https://img.shields.io/badge/-Telegram-blue?logo=telegram)](https://t.me/Joomla_component_builder "Join Llewellyn and the Community on Telegram: Building Joomla Components Together!") [![Mastodon](https://img.shields.io/badge/-Mastodon-9e9eec?logo=mastodon)](https://joomla.social/@llewellyn "Connect and Engage with Llewellyn on Joomla Social: Empowering Communities, One Post at a Time!") [![X (Twitter)](https://img.shields.io/badge/-X-black?logo=x)](https://x.com/llewellynvdm "Join the Conversation with Llewellyn on X: Where Ideas Take Flight!") [![GitHub](https://img.shields.io/badge/-GitHub-181717?logo=github)](https://github.com/Llewellynvdm "Build, Innovate, and Thrive with Llewellyn on GitHub: Turning Ideas into Impact!") [![YouTube](https://img.shields.io/badge/-YouTube-ff0000?logo=youtube)](https://www.youtube.com/@OctoYou "Explore, Learn, and Create with Llewellyn on YouTube: Your Gateway to Inspiration!") [![n8n](https://img.shields.io/badge/-n8n-black?logo=n8n)](https://n8n.io/creators/octoleo "Effortless Automation and Impactful Workflows with Llewellyn on n8n!") [![Docker Hub](https://img.shields.io/badge/-Docker-grey?logo=docker)](https://hub.docker.com/u/llewellyn "Llewellyn on Docker: Containerize Your Creativity!") [![Open Collective](https://img.shields.io/badge/-Donate-green?logo=opencollective)](https://opencollective.com/joomla-component-builder "Donate towards JCB: Help Llewellyn financially so he can continue developing this great tool!") [![GPG Key](https://img.shields.io/badge/-GPG-blue?logo=gnupg)](https://git.vdm.dev/Llewellyn/gpg "Unlock Trust and Security with Llewellyn's GPG Key: Your Gateway to Verified Connections!")