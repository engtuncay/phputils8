<?php

namespace Engtuncay\Phputils8\FiCiHelpers;

class FiCiHelper
{
  public static function getRouteEnt(string $txRouteName, mixed $controller): FiRouteEnt
  {
    // Fast class short name without Reflection
    if (is_string($controller)) {
      $controllerClass = $controller;
    } else {
      $controllerClass = get_class($controller);
    }

    $shortName = basename(str_replace('\\', '/', $controllerClass));

    // route -> method mapping: '-' and '/' become '_'
    $method = str_replace(['-', '/'], '_', $txRouteName);

    // Optional: ensure method exists on controller, otherwise fallback to 'index'
    if (!method_exists($controllerClass, $method)) {
      $method = 'index';
    }

    $txRouteName = str_replace('-', '_', $txRouteName);

    $fiRouteEnt = new FiRouteEnt();
    $fiRouteEnt->setTxRelUrl("/$txRouteName");
    $fiRouteEnt->setClassMethodTarget($shortName . '::' . $method);
    return $fiRouteEnt;
  }

}
