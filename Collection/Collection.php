<?php
namespace SiLibrary;

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
use Countable;
use IteratorAggregate;

class Collection implements IteratorAggregate , Countable {
    use ArrayableTrait, OperatesOnItemsTrait, AggregatesItemsTrait;
    use AggregatesItemsTrait, ComparisonTrait, ManipulationTrait;
    use OperatesOnItemsTrait, PaginationTrait, SearchTrait;
    use TransformationTrait, PropertyAccessTrait;

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
}
