<?php

namespace Railken\Bag\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Railken\Bag;

class BasicTest extends TestCase
{
    public function testInitialize()
    {
        $bag = new Bag(['x' => 1]);

        $this->assertEquals(['x' => 1], $bag->all());
        $this->assertEquals(['x' => 1], $bag->toArray());

        $this->assertEquals(['x' => 1], Bag::factory($bag)->toArray());
    }

    public function testExceptionInvalidArgumentInstance()
    {
        $this->expectException(InvalidArgumentException::class);
        new Bag(5);
    }

    public function testSetAndGet()
    {
        $bag = new Bag(['x' => 1]);

        $bag->set('x', 2);

        $this->assertEquals(2, $bag->get('x'));
        $this->assertEquals(true, $bag->has('x'));
        $this->assertEquals(true, $bag->exists('x'));
        $bag->remove('x');
        $this->assertEquals(false, $bag->has('x'));

        $bag->x = 5;
        $this->assertEquals(5, $bag->x);

        $bag->set('x.1', 2);
        $this->assertEquals(['x' => ['1' => 2]], $bag->toArray());
        $this->assertEquals(2, $bag->get('x.1'));
        $this->assertEquals(true, $bag->has('x.1'));
        $this->assertEquals(false, $bag->has('x.2'));

        $bag->set('x', ['1' => 2]);
        $this->assertEquals(['x' => ['1' => 2]], $bag->toArray());
        $this->assertEquals(2, $bag->get('x.1'));
        $this->assertEquals(true, $bag->has('x.1'));
        $this->assertEquals(false, $bag->has('x.2'));

        $bag->set('x', ['1' => null]);
        $this->assertEquals(true, $bag->has('x.1'));
        $this->assertEquals(null, $bag->get('x.1'));
    }

    public function testKeys()
    {
        $bag = new Bag(['x' => 1, 'y' => 2]);

        $this->assertEquals(['x', 'y'], $bag->keys());
    }

    public function testReplace()
    {
        $bag = new Bag(['x' => 1]);

        $this->assertEquals(['y' => 2], $bag->replace(['y' => 2])->toArray());
    }

    public function testAdd()
    {
        $bag = new Bag(['x' => 1]);

        $this->assertEquals(['x' => 1, 'y' => 2], $bag->add(['y' => 2])->toArray());
    }

    public function testCount()
    {
        $bag = new Bag(['x' => 1]);

        $this->assertEquals(1, $bag->count());
        $this->assertEquals(2, $bag->set('y', 1)->count());
    }

    public function testOnly()
    {
        $bag = new Bag(['x' => 1, 'y' => 2]);

        $new_bag = $bag->only(['x']);

        $this->assertEquals(['x' => 1], $new_bag->toArray());
        $this->assertEquals(['x' => 1, 'y' => 2], $bag->toArray());
    }

    public function testFilter()
    {
        $bag = new Bag(['x' => 1, 'y' => 2]);

        $this->assertEquals(['x' => 1], $bag->filter(['x'])->toArray());
    }
}
