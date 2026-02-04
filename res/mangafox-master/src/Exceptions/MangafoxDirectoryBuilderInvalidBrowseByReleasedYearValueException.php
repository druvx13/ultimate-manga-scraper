<?php
/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
namespace Railken\Mangafox\Exceptions;

class MangafoxDirectoryBuilderInvalidBrowseByReleasedYearValueException extends MangafoxInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        $this->message = sprintf("invalid value '%s' for method %s(), expects: 4 digits year (e.g. 2017 or 'older')", $value, 'browseBy');
    }
}
