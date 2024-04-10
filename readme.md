# JoinAnimation Plugin

This PocketMine-MP plugin provides a customizable welcome experience for players joining your server by playing sounds and displaying messages and titles.

[![](https://poggit.pmmp.io/shield.state/JoinAnimation)](https://poggit.pmmp.io/p/JoinAnimation)
<a href="https://poggit.pmmp.io/p/JoinAnimation"><img src="https://poggit.pmmp.io/shield.state/JoinAnimation"></a>
[![](https://poggit.pmmp.io/shield.api/JoinAnimation)](https://poggit.pmmp.io/p/JoinAnimation)
<a href="https://poggit.pmmp.io/p/JoinAnimation"><img src="https://poggit.pmmp.io/shield.api/JoinAnimation"></a>

## Features

- Plays configurable sounds when players join.
- Sends customizable welcome messages.
- Displays customizable titles upon player join.

## Installation

1. Download the latest version from the [releases page](link/to/releases).
2. Place the downloaded `.phar` file into the `plugins` folder of your PocketMine-MP server.
3. Restart or reload the server.

## Configuration

The plugin can be configured via the `config.yml` file found in the plugin's folder.

### Sound Settings

Users can specify custom sounds to play when players join by adding them to the `sounds.custom_sounds` section of the `config.yml`. The plugin will attempt to play these sounds using the PocketMine-MP 5.0.0 sound classes.

```yaml
# Sound settings
sounds:
  custom_sounds:
    - LaunchSound
    - ExplodeSound
```

### Welcome Message Settings

Users can customize the welcome message sent to players upon joining by modifying the `welcome_message.prefix` and `welcome_message.suffix` settings.

```yaml
# Welcome message settings
welcome_message:
  enabled: true
  prefix: "&aWelcome to RebirthBE, "
  suffix: "&aEnjoy your time here!"
```

### Title Settings

Users can customize the title displayed to players upon joining by modifying the `title.main_title`, `title.subtitle`, `title.fade_in`, `title.stay`, and `title.fade_out` settings.

```yaml
# Title settings
title:
  enabled: true
  main_title: "&bRebirthBE"
  subtitle: "&eFactions"
  fade_in: 20
  stay: 40
  fade_out: 20
```

## Usage

Simply join the server to experience the configured welcome animation!
