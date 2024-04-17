<?php

require_once 'Collection/require.php';

use PHPUnit\Framework\TestCase;
use SiLibrary\Collection;

class OperatesOnItemsTraitTest extends TestCase
{
    protected $collection;

    protected function setUp(): void
    {
        $this->collection = new Collection(['a', 'b', 'c', 10]);
    }

    public function testAll()
    {
        $this->assertEquals(['a', 'b', 'c', 10], $this->collection->all());
    }

    public function testMap()
    {
        $mapped = $this->collection->map(function($item) {
            return is_string($item) ? strtoupper($item) : $item;
        });
        $this->assertEquals(['A', 'B', 'C', 10], $mapped->all());
    }

    public function testFilter()
    {
        $filtered = $this->collection->filter(function($item) {
            return is_string($item);
        });
        $this->assertEquals(['a', 'b', 'c'], $filtered->all());
    }
}