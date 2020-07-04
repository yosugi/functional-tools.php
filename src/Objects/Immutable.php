<?php
declare(strict_types=1);

namespace FunctionalTools\Objects;

use LogicException;
use FunctionalTools\Arrays;
use FunctionalTools\Functions;

trait Immutable
{
    public function __get($name)
    {
        if (!property_exists($this, $name)) {
            $class = get_class($this);
            throw new LogicException("Undefined property \"$class::$name\".");
        }
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $class = get_class($this);
        throw new LogicException("Cannot modify property \"$class::$name\".");
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return mixed (static)
     */
    public function setProperty(string $name, $value)
    {
        $duplication = clone $this;
        $duplication->$name = $value;

        return $duplication;
    }

    /**
     * @param array<string, mixed> $propNameToValueMap
     * @return mixed (static)
     */
    public function setProperties(array $propNameToValueMap)
    {
        return Functions::pipe(
            fn () => $propNameToValueMap,
            Arrays::toPairs(),
            Arrays::reduce(function ($acc, $pair) {
                list ($propName, $value) = $pair;

                $acc->$propName = $value;

                return $acc;
            }, clone $this),
        )();
    }
}

