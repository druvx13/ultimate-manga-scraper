<?php
/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
namespace Railken\Mangafox\Exceptions;

class MangafoxScanBuilderInvalidUrlException extends MangafoxException
{
    public function __construct($url, $suggestion)
    {
        $this->message = sprintf("invalid value '%s' for method %s(), e.g (%s)", $url, 'url', $suggestion);
    }
}
