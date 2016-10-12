[![Packagist](https://img.shields.io/packagist/v/evanlovely/plugin-twig-namespaces.svg)](https://packagist.org/packages/evanlovely/plugin-twig-namespaces) [![Gitter](https://img.shields.io/gitter/room/pattern-lab/php.svg)](https://gitter.im/pattern-lab/php)

# Twig Namespaces Plugin for Pattern Lab

This adds namespaces to Twig in Pattern Lab. 

## Installation

To add the Faker Plugin to your project using [Composer](https://getcomposer.org/) type:

    composer require evanlovely/plugin-twig-namespaces

See Packagist for [information on the latest release](https://packagist.org/packages/evanlovely/plugin-twig-namespaces).

## Usage

In `config.yml`, add this:

```yml
plugins:
  twigNamespaces:
    enabled: true
    roots: 
      - ../root1
      - ../root2
    namespaces:
      foo:
        paths:
          - ../bar
          - ../baz
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
- bar/
    - item1.twig
- baz/
    - item2.twig

You could now use this in Twig:

```twig
{% include "@mountains/hood.twig" %}
{% include "@rivers/sandy.twig" %}
{@ incdlue "@foo/item1.twig" %}
{@ incdlue "@foo/item2.twig" %}
```

You can use either the `roots` or the `namespaces` approach without the other. The `roots` approach is how Pattern Lab registers the namespaces of all folders under `source/_patterns/` like `@atoms` and is therefore useful for including files from other Pattern Labs (watch out for namespace collisions - i.e. you can only have one `@atoms`). And the `namespaces` approach is how the Drupal [Component Libraries](https://www.drupal.org/project/components) module registers Twig namespaces, though it could also be used to register the core modules template files in Pattern Lab so you could `{% extend "@blocks/block.html.twig" %}` if you'd like.

## Disabling the Plugin

To disable the plugin you can either directly edit `./config/config.yml` or use the command line option:

    php core/console --config --set plugins.twigNamespaces.enabled=false

---

**Happy Pattern Labbing!**
