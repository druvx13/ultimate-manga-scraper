<?php
/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
namespace Railken\Mangafox\Exceptions;

class MangafoxParserDateNotSupportedException extends MangafoxException
{
    public function __construct($date)
    {
        $this->message = sprintf('Format %s not supported', $date);
    }
}
