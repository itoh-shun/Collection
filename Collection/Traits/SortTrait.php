<?php
namespace SiLibrary\Traits;

use Closure;

trait SortTrait
{
    /**
     * Sort the collection by value.
     *
     * @param int $options
     * @param bool $descending
     * @return $this
     */
    public function sort($options = SORT_REGULAR, $descending = false)
    {
        if ($descending) {
            arsort($this->items, $options);
        } else {
            asort($this->items, $options);
        }
        $this->items = array_values($this->items);
        return $this;
    }

    /**
     * Sort the collection using the given callback.
     *
     * @param callable|string $callback
     * @param bool $descending
     * @return $this
     */
    public function sortBy($callback, $descending = false)
    {
        $results = [];

        foreach ($this->items as $key => $value) {
            $results[$key] = $callback instanceof Closure ? $callback($value, $key) : $value[$callback];
        }

        $descending ? arsort($results) : asort($results);

        foreach (array_keys($results) as $key) {
            $results[$key] = $this->items[$key];
        }

        $this->items = array_values($results);

        return $this;
    }

    /**
     * Sort the collection in descending order using the given callback.
     *
     * @param callable|string $callback
     * @return $this
     */
    public function sortByDesc($callback)
    {
        return $this->sortBy($callback, true);
    }

    /**
     * Sort the collection by keys.
     *
     * @param int $options
     * @param bool $descending
     * @return $this
     */
    public function sortKeys($options = SORT_REGULAR, $descending = false)
    {
        $method = $descending ? 'krsort' : 'ksort';
        $method($this->items, $options);
        return $this;
    }

    /**
     * Sort the collection keys in descending order.
     *
     * @param int $options
     * @return $this
     */
    public function sortKeysDesc($options = SORT_REGULAR)
    {
        return $this->sortKeys($options, true);
    }

    /**
     * Sort the collection keys using a callback.
     *
     * @param callable $callback
     * @return $this
     */
    public function sortKeysUsing($callback)
    {
        uksort($this->items, $callback);
        return $this;
    }
}