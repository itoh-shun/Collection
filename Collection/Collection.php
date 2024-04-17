<?php
namespace SiLibrary;

use ArrayAccess;
use ArrayIterator;
use SiLibrary\Traits\AggregatesItemsTrait;
use SiLibrary\Traits\ArrayableTrait;
use SiLibrary\Traits\ComparisonTrait;
use SiLibrary\Traits\ManipulationTrait;
use SiLibrary\Traits\OperatesOnItemsTrait;
use SiLibrary\Traits\PaginationTrait;
use SiLibrary\Traits\PropertyAccessTrait;
use SiLibrary\Traits\SearchTrait;
use SiLibrary\Traits\TransformationTrait;
use SiLibrary\Traits\SortTrait;
use Countable;
use IteratorAggregate;

class Collection implements IteratorAggregate , Countable, ArrayAccess {
    use ArrayableTrait, OperatesOnItemsTrait, AggregatesItemsTrait;
    use ComparisonTrait, ManipulationTrait;
    use PaginationTrait, SearchTrait;
    use TransformationTrait, PropertyAccessTrait;
    use SortTrait;

    /**
     * The items contained in the collection.
     * 
     * @var array
     */
    protected $items = [];

    /**
     * Create a new collection.
     * 
     * @param mixed $items
     */
    public function __construct($items = []) {
        $this->items = $this->getArrayableItems($items);

        // Convert sub-arrays to Collection instances
        foreach ($this->items as $key => $value) {
            if (is_array($value)) {
                $this->items[$key] = new self($value);
            }
        }
    }

    /**
     * Retrieve an external iterator.
     *
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator {
        return new ArrayIterator($this->items);
    }
    
    
    /**
     * Count elements of the collection.
     *
     * @return int
     */
    public function count(): int {
        return count($this->items);
    }

    
    public function offsetSet($offset, $value): void {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool {
        return isset($this->items[$offset]);
    }

    public function offsetUnset($offset): void {
        unset($this->items[$offset]);
    }

    /**
     * offsetGet.
     * 
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset) {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }
}
