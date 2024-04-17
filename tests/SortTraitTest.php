<?php

require_once 'Collection/require.php';

use PHPUnit\Framework\TestCase;
use SiLibrary\Collection;

class SortTraitTest extends TestCase
{
    public function testSortByName()
    {
        $collection = new Collection([
            ['id' => 2, 'name' => 'Alice'],
            ['id' => 3, 'name' => 'Carol'],
            ['id' => 1, 'name' => 'Bob'],
        ]);

        $sorted = $collection->sortBy('name');
        $expected = new Collection([
            ['id' => 2, 'name' => 'Alice'],
            ['id' => 1, 'name' => 'Bob'],
            ['id' => 3, 'name' => 'Carol'],
        ]);

        $this->assertEquals($expected->all(), $sorted->all(), "The items should be sorted by name in ascending order.");
    }

    public function testSortByKeys()
    {
        $collection = new Collection([10 => 'a', 3 => 'b', 6 => 'c']);
        $sorted = $collection->sortKeys();
        $expected = [3 => 'b', 6 => 'c', 10 => 'a'];
        $this->assertEquals($expected, $sorted->all(), "The keys should be sorted in ascending order.");
    }

    public function testSortDescending()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);
        $sorted = $collection->sort(SORT_NUMERIC, true);

        $expected = [5, 4, 3, 2, 1];
        $this->assertEquals($expected, $sorted->all(), "The items should be sorted in descending order.");
    }
}