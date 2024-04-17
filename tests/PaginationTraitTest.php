<?php
require_once 'Collection/require.php';

use PHPUnit\Framework\TestCase;
use SiLibrary\Collection;

class PaginationTraitTest extends TestCase
{
    protected $collection;

    protected function setUp(): void
    {
        $this->collection = new Collection(range(1, 50));
    }

    public function testPaginate()
    {
        $firstPage = $this->collection->paginate(10, 1);
        $secondPage = $this->collection->paginate(10, 2);

        $this->assertEquals(range(1, 10), $firstPage->all());
        $this->assertEquals(range(11, 20), $secondPage->all());
    }

    public function testChunk()
    {
        $chunks = $this->collection->chunk(10);
        $this->assertCount(5, $chunks);
        $this->assertEquals(range(1, 10), $chunks[0]->all());
        $this->assertEquals(range(11, 20), $chunks[1]->all());
    }
}