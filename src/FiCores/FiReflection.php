<?php
namespace Engtuncay\Phputils8\FiCores;

use ReflectionClass;

class FiReflection
{
  public static function getClassShortName($classFullName)
  {
    $reflector = new ReflectionClass($classFullName);
    return $reflector->getShortName();
  }

}