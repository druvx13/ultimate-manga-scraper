<?php
/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
namespace Railken\Mangafox\Exceptions;

class MangafoxSearchBuilderInvalidFilterException extends MangafoxInvalidArgumentException
{
    public function __construct($field, $value = null, $suggestions = [])
    {
        return parent::__construct($field, $value, $suggestions);
    }
}
