<?php
require_once 'Collection/require.php';

use PHPUnit\Framework\TestCase;
use SiLibrary\Collection;

class TransformationTraitTest extends TestCase
{
    protected $collection;

    protected function setUp(): void
    {
        // コレクションを辞書型で設定します。
        $this->collection = new Collection([
            ['id' => 1, 'name' => 'apple'],
            ['id' => 2, 'name' => 'banana'],
            ['id' => 3, 'name' => 'cherry']
        ]);
    }

    public function testPluck()
    {
        $names = $this->collection->pluck('name');
        $this->assertEquals(['apple', 'banana', 'cherry'], $names->all());

        // キーも指定して抽出する場合
        $namesWithIds = $this->collection->pluck('name', 'id');
        $this->assertEquals([1 => 'apple', 2 => 'banana', 3 => 'cherry'], $namesWithIds->all());
    }

    public function testKeys()
    {
        $keys = $this->collection->keys();
        $this->assertEquals([0, 1, 2], $keys->all());
    }

    public function testValues()
    {
        $values = $this->collection->values();
        $result = new Collection([
            ['id' => 1, 'name' => 'apple'],
            ['id' => 2, 'name' => 'banana'],
            ['id' => 3, 'name' => 'cherry']
        ]);
        $this->assertEquals($result->all(), $values->all());
    }
}