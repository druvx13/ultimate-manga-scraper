<?php
/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
use PHPUnit\Framework\TestCase;
use Railken\Mangafox\Mangafox;

class IndexTest extends TestCase
{
    /**
     * @var Railken\Mangafox\Mangafox
     */
    private $manager;

    /**
     * Called on setup.
     */
    public function setUp()
    {
        $this->manager = new Mangafox();
    }

    public function testIndexBase()
    {
        $results = $this->manager
            ->index()
            ->get();
    }
}
