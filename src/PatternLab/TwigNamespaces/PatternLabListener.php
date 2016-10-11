<?php

/*!
 * Faker Listener Class
 *
 * Copyright (c) 2016 Dave Olsen, http://dmolsen.com
 * Licensed under the MIT license
 *
 * Adds Faker support to Pattern Lab
 *
 */

namespace PatternLab\TwigNamespaces;

use \PatternLab\Config;
use \PatternLab\Console;
use \PatternLab\PatternEngine\Twig\TwigUtil;
use \PatternLab\PatternEngine\Twig\Loaders\Twig\PatternPartialLoader;
use \PatternLab\PatternEngine\Twig\Loaders\PatternLoader;

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
			$namespaces = $config["roots"];
			foreach ($namespaces as $namespace) {
				$loader = new \Twig_Loader_Filesystem(array($basePath . $namespace));
				TwigUtil::addPaths($loader, $basePath . $namespace);
				TwigUtil::addLoader($loader);
			}
		}
  }

}
