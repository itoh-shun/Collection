<?php
namespace SiLibrary\Traits;

use SiLibrary\Collection;
trait TransformationTrait {
    /**
     * Get the values of a single key from the collection.
     *
     * @param  string  $value
     * @param  string|null  $key
     * @return static
     */
    public function pluck(string $value, ?string $key = null): Collection {
        $items = [];

        
        foreach ($this->items as $item) {
            if (isset($item[$value])) {
                if (is_null($key)) {
                    $items[] = $item[$value];
                } else {
                    $items[$item[$key]] = $item[$value];
                }
            }
        }
        /** @phpstan-ignore-next-line */
        return new static($items);
    }

    /**
     * Get all the keys from the collection.
     *
     * @return static
     */
    public function keys(): Collection {
        /** @phpstan-ignore-next-line */
        return new static(array_keys($this->items));
    }

    /**
     * Get all the values from the collection.
     *
     * @return static
     */
    public function values(): Collection {
        /** @phpstan-ignore-next-line */
        return new static(array_values($this->items));
    }
    
    /**
     * Group the collection's items by a given key or using a callback.
     *
     * @param mixed $groupBy
     * @return static
     */
    public function groupBy($groupBy)
    {
        $grouped = [];
        foreach ($this->items as $item) {
            $key = is_callable($groupBy) ? $groupBy($item) : (is_object($item) ? $item->$groupBy : $item[$groupBy]);
            $grouped[$key][] = $item;
        }
        return new static($grouped);
    }

    /**
     * Flatten a multi-dimensional collection into a single dimension.
     *
     * @param int $depth The maximum depth to flatten to.
     * @return static
     */
    public function flatten($depth = INF)
    {
        $result = [];
        $array = $this->items;

        $iterator = function ($array, $currentDepth) use (&$iterator, &$result, $depth) {
            if ($currentDepth > $depth) {
                return;
            }

            foreach ($array as $item) {
                if (is_array($item) || $item instanceof Collection) {
                    if ($currentDepth < $depth) {
                        $iterator($item instanceof Collection ? $item->all() : $item, $currentDepth + 1);
                    } else {
                        $result[] = $item->toArray();
                    }
                } else {
                    $result[] = $item->toArray();
                }
            }
        };

        $iterator($array, 1);

        return new static($result);
    }
}