<?php

require_once 'Collection/require.php';

use PHPUnit\Framework\TestCase;
use SiLibrary\Collection;

class AggregatesItemsTraitTest extends TestCase
{
    protected $collection;

    protected function setUp(): void
    {
        $this->collection = new Collection([10, 20, 30]);
    }

    public function testSum()
    {
        $this->assertEquals(60, $this->collection->sum());
    }

    public function testAvg()
    {
        $this->assertEquals(20, $this->collection->avg());
    }

    public function testAvgWithEmptyCollection()
    {
        $emptyCollection = new Collection([]);
        $this->assertEquals(0.0, $emptyCollection->avg());
    }
}