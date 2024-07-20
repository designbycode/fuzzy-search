<?php

use Designbycode\FuzzySearch\FuzzySearch;

test('search returns similar matches', function () {
    $index = ['apple', 'banana', 'orange', 'grape', 'pear'];
    $fuzzySearch = new FuzzySearch($index);
    $results = $fuzzySearch->search('aple');
    expect($results)->toEqual(['apple']);
});

test('search returns no results for non-existent query', function () {
    $index = ['apple', 'banana', 'orange', 'grape', 'pear'];
    $fuzzySearch = new FuzzySearch($index);
    $results = $fuzzySearch->search('xyz');
    expect($results)->toEqual([]);
});

test('search returns exact match', function () {
    $index = ['apple', 'banana', 'orange', 'grape', 'pear'];
    $fuzzySearch = new FuzzySearch($index);
    $results = $fuzzySearch->search('apple');
    expect($results)->toEqual(['apple']);
});

test('search is case-insensitive', function () {
    $index = ['Apple', 'banana', 'orange', 'grape', 'pear'];
    $fuzzySearch = new FuzzySearch($index);
    $results = $fuzzySearch->search('aPpLe');
    expect($results)->toEqual(['Apple']);
});
