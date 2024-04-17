<?php

require_once 'Collection/require.php';

use PHPUnit\Framework\TestCase;
use SiLibrary\Collection;

class OperatesOnItemsTraitTest extends TestCase
{
    protected $collection;
    protected $original;


    
    protected function setUp(): void
    {
        $this->original = [
            new stdClass(),
            new DateTime(),
            new ArrayObject(),
            (object)['key' => 'value', 'number' => 5],
            (object)['key' => 'test', 'number' => 10],
            (object)['key' => 'value', 'number' => 20]
        ];
        $this->collection = new Collection($this->original);
    }

    public function testAll()
    {
        $this->assertEquals($this->original, $this->collection->all());
    }

    public function testMap()
    {
        $collection = new Collection([
            'a' , 'b' , 'c' , 10
        ]);
        $mapped = $collection->map(function($item) {
            return is_string($item) ? strtoupper($item) : $item;
        });

        $this->assertEquals(['A', 'B', 'C', 10], $mapped->all());
    }

    public function testFilter()
    {
        $collection = new Collection([
            'a' , 'b' , 'c' , 10
        ]);
        $filtered = $collection->filter(function($item) {
            return is_string($item);
        });
        $this->assertEquals(['a', 'b', 'c'], $filtered->all());
    }

    public function testWhereInstanceOf()
    {
        $results = $this->collection->whereInstanceOf(DateTime::class);
        $this->assertCount(1, $results);
        $this->assertInstanceOf(DateTime::class, $results->first());
    }

    public function testWhereStrict()
    {
        $results = $this->collection->whereStrict('key', 'value');
        $this->assertCount(2, $results);
        foreach ($results as $result) {
            $this->assertEquals('value', $result->key);
        }
    }

    public function testWhereBetween()
    {
        $results = $this->collection->whereBetween('number', 5, 15);
        $this->assertCount(2, $results);
        foreach ($results as $result) {
            $this->assertGreaterThanOrEqual(5, $result->number);
            $this->assertLessThanOrEqual(15, $result->number);
        }
    }
}