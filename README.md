# functional-tools.php

Simple functional tools in PHP

## Usage

see tests/

## Installation

```
$ composer require yosugi/functional-tools.php
```

## Methods

### Arrays

- get(string $key, ?array $argInputArray = null) //: callable|mixed
- set(string $key, $value, ?array $argInputArray = null) //: callable|array
- flatten(array $argInputs) //: array
- toPairs(array $argInputs) //: array
- fromPairs(array $argInputs) //: array
- keys(array $argInputs) //: array
- values(iterable $argInputs) //: array
- filter(callable $predicate, ?array $argInputs = null) //: callable|array
- map(callable $fn, ?array $argInputs = null) //: callable|array
- reduce(callable $fn, $initial, ?array $argInputs = null) //: callable|mixed
- head(array $argInputs) //: array
- rest(array $argInputs) //: callable|array
- sortBy(callable $fn, ?array $argInputs = null) //: callable|array

### Collections

- filter(callable $predicate, ?iterable $argInputs = null) //: callable|array
- map(callable $fn, ?iterable $argInputs = null) //: callable|array
- reduce(callable $fn, $initial, ?iterable $argInputs = null) //: callable|mixed
- head(iterable $argInputs) //: array
- rest(iterable $argInputs) //: array
- sortBy(callable $fn, ?iterable $argInputs = null) //: callable|array

### Functions

- compose(callable ...$fns): callable
- pipe(callable ...$fns): callable
- partial(callable $fn, ...$args): callable
- curry(callable $fn, ...$args): callable
- tap($value) //: mixed

### Strings

- split(string $delimiter, ?string $string = null) //: callable|string
- join(string $glue, ?array $pieces = null) //: callable|string
- replace($search, $replace, ?string $subject = null) //: callable|string
- pregReplace($pattern, $replacement, ?string $subject = null) //: callable|string
- trim(string $string) //: callable|string

## License

[MIT License](LICENSE)
