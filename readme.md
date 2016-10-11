[![Packagist](https://img.shields.io/packagist/v/pattern-lab/plugin-faker.svg)](https://packagist.org/packages/pattern-lab/plugin-faker) [![Gitter](https://img.shields.io/gitter/room/pattern-lab/php.svg)](https://gitter.im/pattern-lab/php)

# Twig Namespaces Plugin for Pattern Lab

This adds namespaces to Twig in Pattern Lab. 

## Installation

To add the Faker Plugin to your project using [Composer](https://getcomposer.org/) type:

    composer require evanlovely/plugin-twig-namespaces

See Packagist for [information on the latest release](https://packagist.org/packages/evan-lovely/plugin-twig-namespaces).

## Usage

In `config.yml`, add this:

```yml
plugins:
  twigNamespaces:
    enabled: true
    roots: 
      - ../root1
      - ../root2
```

Paths are relative to `composer.json` and `vendor/` in the same directory as the config directory (not config file). Assuming this folder structure

- pattern-lab/
  - config/
    - config.yml
  - composer.json
- root1/
  - 01-mountains/
    - hood.twig
  - 02-rivers
    - sandy.twig

You could now use this in Twig:

```twig
{% include "@mountains/hood.twig" %}
{% include "@rivers/sandy.twig" %}
```

## Disabling the Plugin

To disable the plugin you can either directly edit `./config/config.yml` or use the command line option:

    php core/console --config --set plugins.twigNamespaces.enabled=false
