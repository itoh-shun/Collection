<?php
require_once 'Collection/require.php';

use PHPUnit\Framework\TestCase;
use SiLibrary\Collection;

class PropertyAccessTraitTest extends TestCase
{
    protected $collection;

    protected function setUp(): void
    {
        $this->collection = new Collection();
    }

    public function testSetAndGet()
    {
        $this->collection->set('color', 'blue');
        $this->assertEquals('blue', $this->collection->get('color'));

        // Testing magic methods
        $this->collection->color = 'red';
        $this->assertEquals('red', $this->collection->color);
    }

    public function testRemove()
    {
        $this->collection->set('color', 'green');
        $this->assertEquals('green', $this->collection->get('color'));
        $this->collection->remove('color');
        $this->assertNull($this->collection->get('color'));
    }
}