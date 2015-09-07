<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

$loader->addPsr4("Greetings\\", __DIR__.'/../../Greetings', true);
$loader->addPsr4("Costumer\\", __DIR__.'/../../Costumer', true);

return $loader;
