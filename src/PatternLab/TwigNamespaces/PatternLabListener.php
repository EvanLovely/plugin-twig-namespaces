<?php

/*!
 * Twig Namespace Listener Class
 *
 * Copyright (c) 2016 Evan Lovely, http://evanlovely.com
 * Licensed under the MIT license
 *
 * Allows Twig Namespaces to be added to Pattern Lab
 *
 */

namespace PatternLab\TwigNamespaces;

use \PatternLab\Config;
use \PatternLab\PatternEngine\Twig\TwigUtil;
use \Twig_Loader_Filesystem;
use \BasaltInc\TwigTools;

class PatternLabListener extends \PatternLab\Listener {

  /**
   * Add the listeners for this plug-in
   */
  public function __construct() {

    // add listener
    $this->addListener("twigLoaderPreInit.customize","addTwigNamespaces");

  }

  public function addTwigNamespaces() {
    $config = Config::getOption("plugins.twigNamespaces");
    $basePath = Config::getOption("baseDir");
    if ($config["enabled"]) {

      // Pattern Lab approach
      // Each root has each sub-directory added as namespace in the same way that
      // Pattern Lab's Twig Engine adds main pattern directories as namespaces
      // `00-atoms` => `@atoms`
      if (array_key_exists("roots", $config)) {
        foreach ($config["roots"] as $root) {
          $loader = new Twig_Loader_Filesystem(array($basePath . $root));
          TwigUtil::addPaths($loader, $basePath . $root);
          TwigUtil::addLoader($loader);
        }
      }

      $namespacesConfig = [];
      if (array_key_exists("readFromFile", $config)) {
        $namespacesConfig = TwigTools\Utils::getData($config['readFromFile']);
      } elseif (array_key_exists("namespaces", $config)) {
        $namespacesConfig = $config['namespaces'];
      }
      
      // Drupal approach
      // Each key becomes the namespace for all `paths` inside
      // Follows data model from Drupal module: https://www.drupal.org/project/components
      if ($namespacesConfig) {
        $loader2 = new Twig_Loader_Filesystem(array());
        $namespaces = TwigTools\Namespaces::buildLoaderConfig($namespacesConfig, Config::getOption('baseDir'));
        foreach ($namespaces as $namespace => $item) {
          foreach ($item["paths"] as $path) {
            $loader2->addPath($path, $namespace);
          }
        }
        TwigUtil::addLoader($loader2);
      }

    }
  }

}
