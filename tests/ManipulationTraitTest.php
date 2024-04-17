<?php
require_once 'Collection/require.php';

use PHPUnit\Framework\TestCase;
use SiLibrary\Collection;

class ManipulationTraitTest extends TestCase
{
    protected $collection;

    protected function setUp(): void
    {
        $this->collection = new Collection(['apple', 'banana', 'cherry']);
    }

    public function testPrepend()
    {
        $this->collection->prepend('date');
        $this->assertEquals(['date', 'apple', 'banana', 'cherry'], $this->collection->all());
    }

    public function testShuffle()
    {
        $original = $this->collection->all();
        $shuffled = $this->collection->shuffle();
        $shuffled = $shuffled->all();
        $this->assertCount(3, $shuffled);
    }

    public function testReverse()
    {
        $this->collection->reverse();
        $this->assertEquals([2 => 'cherry', 1 => 'banana', 0 => 'apple'], $this->collection->all());
    }
}