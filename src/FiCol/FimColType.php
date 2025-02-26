<?php

namespace Engtuncay\Phputils8\FiCol;

enum FimColType:string
{
  case String = 'string';
  case Integer = 'integer';
  case Float = 'float';
  case Boolean = 'boolean';
  case Date = 'date';
  case Time = 'time';
  case Datetime = 'datetime';

}