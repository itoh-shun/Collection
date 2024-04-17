<?php
require_once 'Collection/require.php';

use PHPUnit\Framework\TestCase;
use SiLibrary\Collection;

class TransformationTraitTest extends TestCase
{
    protected $collection;

    protected function setUp(): void
    {
        $this->collection = new Collection([
            ['id' => 1, 'name' => 'Alice', 'group' => 'admin'],
            ['id' => 2, 'name' => 'Bob', 'group' => 'user'],
            ['id' => 3, 'name' => 'Charlie', 'group' => 'admin'],
            ['id' => 4, 'name' => 'David', 'group' => 'user'],
            ['id' => 5, 'name' => 'Eve', 'group' => 'guest']
        ]);
    }

    public function testMap()
    {
        $names = $this->collection->map(function ($item) {
            return strtoupper($item['name']);
        });
        $expected = ['ALICE', 'BOB', 'CHARLIE', 'DAVID', 'EVE'];
        $this->assertEquals($expected, $names->all());
    }

    public function testPluck()
    {
        $names = $this->collection->pluck('name');
        $expected = ['Alice', 'Bob', 'Charlie', 'David', 'Eve'];
        $this->assertEquals($expected, $names->all());
    }

    public function testKeys()
    {
        $keys = $this->collection->keys();
        $expected = [0, 1, 2, 3, 4];
        $this->assertEquals($expected, $keys->all());
    }


    public function testGroupBy()
    {
        $grouped = $this->collection->groupBy('group');
        $expectedKeys = ['admin', 'user', 'guest'];
        $this->assertEquals($expectedKeys, array_keys($grouped->all()));
        $this->assertCount(2, $grouped->get('admin'));
        $this->assertCount(2, $grouped->get('user'));
        $this->assertCount(1, $grouped->get('guest'));
    }

    public function testFlatten()
    {
            
        $collection = new Collection([
            'Apple' => [
                [
                    'name' => 'iPhone 6S',
                    'brand' => 'Apple'
                ],
            ],
            'Samsung' => [
                [
                    'name' => 'Galaxy S7',
                    'brand' => 'Samsung'
                ],
            ],
        ]);
        $flattened = $collection->flatten(2);
        $expected = new Collection([
            ['name' => 'iPhone 6S', 'brand' => 'Apple'],
            ['name' => 'Galaxy S7', 'brand' => 'Samsung']
        ]);
        $this->assertEquals($expected->all(), $flattened->all());
    }

    public function testValues()
    {
        $result = new Collection([
            ['id' => 1, 'name' => 'apple'],
            ['id' => 2, 'name' => 'banana'],
            ['id' => 3, 'name' => 'cherry']
        ]);
        $values = $result->values();
        $this->assertEquals($result->all(), $values->all());
    }
}