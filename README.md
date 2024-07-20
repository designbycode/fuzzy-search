# Fuzzy Search

[![Latest Version on Packagist](https://img.shields.io/packagist/v/designbycode/fuzzy-search.svg?style=flat-square)](https://packagist.org/packages/designbycode/fuzzy-search)
[![Tests](https://img.shields.io/github/actions/workflow/status/designbycode/fuzzy-search/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/designbycode/fuzzy-search/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/designbycode/fuzzy-search.svg?style=flat-square)](https://packagist.org/packages/designbycode/fuzzy-search)

## Introduction
The Fuzzy Search package provides a simple and efficient way to perform fuzzy searches on a collection of texts using the Levenshtein distance algorithm. This package is useful when you need to search for texts that may contain typos or slight variations.

## Installation

To install the Fuzzy Search package, simply require it in your PHP project using Composer:

```bash
composer require designbycode/fuzzy-search
```

## Usage
### Creating a Fuzzy Search Instance
To create a Fuzzy Search instance, you need to pass an array of texts to search and an optional flag for case-insensitive search:

```php
use Designbycode\FuzzySearch\FuzzySearch;

$texts = ['apple', 'banana', 'orange', 'grape'];
$fuzzySearch = new FuzzySearch($texts, true); // Case-insensitive search
```

## Performing a Fuzzy Search
To perform a fuzzy search, call the `search` method and pass the search query and an optional maximum Levenshtein distance:

```php
$query = 'aple';
$maxDistance = 2;
$results = $fuzzySearch->search($query, $maxDistance);
print_r($results); // Output: ['apple']
```

The search method returns an array of matching texts, sorted by their Levenshtein distance from the search query.

## Getting the Best Match
To get the best match from the search results, call the getBestMatch method:
```php
$bestMatch = $fuzzySearch->getBestMatch($results);
echo $bestMatch; // Output: 'apple'
```

## Levenshtein Distance Calculator
The Levenshtein Distance Calculator is a utility class that calculates the Levenshtein distance between two strings. This class is used internally by the Fuzzy Search package.

### Calculating the Levenshtein Distance
To calculate the Levenshtein distance between two strings, call the calculate method:

```php
use Designbycode\FuzzySearch\LevenshteinDistance;

$str1 = 'kitten';
$str2 = 'sitting';
$distance = LevenshteinDistance::calculate($str1, $str2);
echo $distance; // Output: 3
```

## Examples
### Example 1: Fuzzy Search with Case-Insensitive Search
```php
$texts = ['Apple', 'Banana', 'Orange', 'Grape'];
$fuzzySearch = new FuzzySearch($texts, true);

$query = 'aple';
$maxDistance = 2;
$results = $fuzzySearch->search($query, $maxDistance);
print_r($results); // Output: ['Apple']
```

### Example 2: Fuzzy Search with Case-Sensitive Search
```php
$texts = ['apple', 'banana', 'orange', 'grape'];
$fuzzySearch = new FuzzySearch($texts, false);

$query = 'Aple';
$maxDistance = 2;
$results = $fuzzySearch->search($query, $maxDistance);
print_r($results); // Output: []
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Claude Myburgh](https://github.com/designbycode)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
