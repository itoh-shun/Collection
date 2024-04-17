<?php
require_once 'Collection/require.php';

use PHPUnit\Framework\TestCase;
use SiLibrary\Collection;

class SearchTraitTest extends TestCase
{
    protected $collection;

    protected function setUp(): void
    {
        $this->collection = new Collection(['apple', 'banana', 'cherry']);
    }

    public function testSearch()
    {
        $this->assertEquals(1, $this->collection->search('banana'));
        $this->assertFalse($this->collection->search('date'));
    }

    public function testFirst()
    {
        $this->assertEquals('apple', $this->collection->first());
        $firstFruitWithMoreThanFiveLetters = $this->collection->first(function($item) {
            return strlen($item) > 5;
        });
        $this->assertEquals('banana', $firstFruitWithMoreThanFiveLetters);
    }

    public function testLast()
    {
        $this->assertEquals('cherry', $this->collection->last());
        $lastFruitWithLessThanSixLetters = $this->collection->last(function($item) {
            return strlen($item) < 6;
        });
        $this->assertEquals('apple', $lastFruitWithLessThanSixLetters);
    }
}