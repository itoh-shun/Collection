<?php
require_once 'Collection/require.php';

use PHPUnit\Framework\TestCase;
use SiLibrary\Collection;

class ComparisonTraitTest extends TestCase
{
    protected $collection;

    protected function setUp(): void
    {
        $this->collection = new Collection(['apple', 'banana', 'cherry', 'banana']);
    }

    public function testDiff()
    {
        $otherCollection = new Collection(['banana']);
        $diffCollection = $this->collection->diff($otherCollection);
        $this->assertEquals([ 0 => 'apple', 2 => 'cherry'], $diffCollection->all());
    }

    public function testIntersect()
    {
        $otherCollection = new Collection(['banana', 'dragonfruit']);
        $intersectCollection = $this->collection->intersect($otherCollection);
        $this->assertEquals([ 1 => 'banana', 3 => 'banana'], $intersectCollection->all());
    }

    public function testUnique()
    {
        $uniqueCollection = $this->collection->unique();
        $this->assertEquals(['apple', 'banana', 'cherry'], $uniqueCollection->all());
    }
}