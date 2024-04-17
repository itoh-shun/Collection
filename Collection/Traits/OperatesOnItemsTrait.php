<?php
namespace SiLibrary\Traits;

use SiLibrary\Collection;

trait OperatesOnItemsTrait {
    /**
     * Get all of the items in the collection.
     * 
     * @return array
     */
    public function all(): array {
        return $this->items;
    }

    /**
     * Apply a callback to each item and return a new collection.
     * 
     * @param callable $callback
     * @return Collection
     */
    public function map(callable $callback): Collection {
        /** @phpstan-ignore-next-line */
        return new static(array_map($callback, $this->items));
    }

    /**
     * Filter the items by a callback and return a new collection.
     * 
     * @param callable $callback
     * @return Collection
     */
    public function filter(callable $callback): Collection {
        /** @phpstan-ignore-next-line */
        return new static(array_filter($this->items, $callback, ARRAY_FILTER_USE_BOTH));
    }
    

    /**
     * Filter the collection by a given key-value pair.
     *
     * @param string $key
     * @param mixed $value
     * @return static
     */
    public function where(string $key, $value): Collection {
        return $this->filter(function (Collection $item) use ($key, $value) {
            return $item->{$key} === $value;
        });
    }

    /**
     * Filter the collection by a given key-value pair where the value is not matching.
     *
     * @param string $key
     * @param mixed $value
     * @return static
     */
    public function whereNot(string $key, $value): Collection {
        return $this->filter(function (Collection $item) use ($key, $value) {
            return $item->{$key} !== $value;
        });
    }

    /**
     * Filter the collection by a given key-value pair where the value is in the given array.
     *
     * @param string $key
     * @param array $values
     * @return static
     */
    public function whereIn(string $key, array $values): Collection {
        return $this->filter(function (Collection $item) use ($key, $values) {
            return in_array($item->{$key}, $values);
        });
    }

    /**
     * Filter the collection by a given key-value pair where the value is not in the given array.
     *
     * @param string $key
     * @param array $values
     * @return static
     */
    public function whereNotIn(string $key, array $values): Collection {
        return $this->filter(function (Collection $item) use ($key, $values) {
            return !in_array($item->{$key}, $values);
        });
    }

    /**
     * Filter the collection using the given callback.
     *
     * @param callable $callback
     * @return static
     */
    public function reject(callable $callback): Collection {
        /** @phpstan-ignore-next-line */
        return new static(array_filter($this->items, function($item , $key) use ($callback) {
            return !$callback($item , $key);
        }, ARRAY_FILTER_USE_BOTH));
    }

    /**
     * Filter items based on instance type.
     *
     * @param string $className
     * @return static
     */
    public function whereInstanceOf($className)
    {
        return $this->filter(function ($item) use ($className) {
            return $item instanceof $className;
        });
    }
    
    /**
     * Return items where the given key's value matches the provided value strictly.
     *
     * @param string $key
     * @param mixed $value
     * @return static
     */
    public function whereStrict($key, $value)
    {
        return new static(array_filter($this->items, function ($item) use ($key, $value) {
            return isset($item->$key) && $item->$key === $value && gettype($item->$key) === gettype($value);
        }));
    }



    /**
     * Filter items based on a range between two values.
     *
     * @param string $key
     * @param mixed $from
     * @param mixed $to
     * @return static
     */
    public function whereBetween($key, $from, $to)
    {
        return new static(array_filter($this->items, function ($item) use ($key, $from, $to) {
            return isset($item->$key) && $item->$key >= $from && $item->$key <= $to;
        }));
    }
}