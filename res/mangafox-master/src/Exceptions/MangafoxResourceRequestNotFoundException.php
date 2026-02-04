<?php
/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
namespace Railken\Mangafox\Exceptions;

class MangafoxResourceRequestNotFoundException extends MangafoxException
{
    public function __construct($uid)
    {
        $this->message = sprintf("The resource %s doesn't exist or is invalid", $uid);
    }
}
