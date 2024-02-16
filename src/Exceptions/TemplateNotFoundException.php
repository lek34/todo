<?php

namespace Uph22si1Web\Todo\Exceptions;

class TemplateNotFoundException extends \Exception
{
  function __construct($message = '', $code = 0, \Throwable $previous = null)
  {
    parent::__construct($message, $code, $previous);
  }
}
