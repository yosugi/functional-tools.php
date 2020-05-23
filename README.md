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
- flatten(?array $argInputs = null) //: callable|array
- toPairs(?array $argInputs = null) //: callable|array
- fromPairs(?array $argInputs = null) //: callable|array
- keys(?array $argInputs = null) //: callable|array
- values(?array $argInputs = null) //: callable|array
- filter(callable $predicate, ?array $argInputs = null) //: callable|array
- map(callable $fn, ?array $argInputs = null) //: callable|array
- reduce(callable $fn, $initial, ?array $argInputs = null) //: callable|mixed
- head(?array $argInputs = null) //: callable|array
- rest(?array $argInputs = null) //: callable|array
- sortBy(callable $fn, ?array $argInputs = null) //: callable|array

### Collections

- filter(callable $predicate, ?iterable $argInputs = null) //: callable|array
- map(callable $fn, ?iterable $argInputs = null) //: callable|array
- reduce(callable $fn, $initial, ?iterable $argInputs = null) //: callable|mixed
- head(?iterable $argInputs = null) //: callable|array
- rest(?iterable $argInputs = null) //: callable|array
- sortBy(callable $fn, ?iterable $argInputs = null) //: callable|array

### Functions

- compose(callable ...$fns): callable
- pipe(callable ...$fns): callable
- partial(callable $fn, ...$args): callable
- curry(callable $fn, ...$args): callable
- tap(...$argInputs) //: mixed

### Strings

- split(string $delimiter, ?string $argInput = null) //: callable|string
- join(string $glue, ?array $argInputs = null) //: callable|string
- replace($search, $replace, ?string $argInput = null) //: callable|string
- pregReplace($pattern, $replacement, ?string $argInput = null) //: callable|string
- trim(?string $argInput = null) //: callable|string

## License

[MIT License](LICENSE)
