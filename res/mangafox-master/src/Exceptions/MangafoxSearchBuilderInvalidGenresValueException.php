<?php
/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
namespace Railken\Mangafox\Exceptions;

class MangafoxSearchBuilderInvalidGenresValueException extends MangafoxInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('genres', implode(', ', $value), $suggestions);
    }
}
