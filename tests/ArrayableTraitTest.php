<?php
require_once 'Collection/require.php';

use PHPUnit\Framework\TestCase;
use SiLibrary\Collection;

class ArrayableTraitTest extends TestCase
{
    protected $collection;

    protected function setUp(): void
    {
        $this->collection = new Collection(['a', 'b', 'c', new Collection(['d', 'e'])]);
    }

    public function testToArray()
    {
        $expected = ['a', 'b', 'c', ['d', 'e']];
        $this->assertEquals($expected, $this->collection->toArray());
    }

    public function testCount()
    {
        $this->assertEquals(4, $this->collection->count());
    }

    public function testGetArrayableItemsWithArray()
    {
        $items = ['x', 'y', 'z'];
        $result = $this->invokeMethod($this->collection, 'getArrayableItems', [$items]);
        $this->assertEquals($items, $result);
    }

    public function testGetArrayableItemsWithTraversable()
    {
        $items = new ArrayIterator(['x', 'y', 'z']);
        $result = $this->invokeMethod($this->collection, 'getArrayableItems', [$items]);
        $this->assertEquals(['x', 'y', 'z'], $result);
    }

    public function testGetArrayableItemsWithJsonSerializable()
    {
        $items = new class implements JsonSerializable {
            public function jsonSerialize()
            {
                return ['x', 'y', 'z'];
            }
        };
        $result = $this->invokeMethod($this->collection, 'getArrayableItems', [$items]);
        $this->assertEquals(['x', 'y', 'z'], $result);
    }

    protected function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }
}