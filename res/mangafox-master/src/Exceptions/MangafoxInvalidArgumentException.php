<?php
/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
namespace Railken\Mangafox\Exceptions;

class MangafoxInvalidArgumentException extends MangafoxException
{
    public function __construct($field, $value = null, $suggestions = [])
    {
        $this->message = sprintf("invalid value '%s' for method %s(), expects: ".implode(', ', $suggestions).'', $value, $field);
    }
}
