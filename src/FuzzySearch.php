<?php

namespace Designbycode\FuzzySearch;

/**
 * Fuzzy search class using Levenshtein distance algorithm
 */
class FuzzySearch
{
    /**
     * Array of texts to search
     */
    private array $texts;

    /**
     * Levenshtein distance calculator
     */
    private LevenshteinDistance $levenshteinDistance;

    /**
     * Flag for case-insensitive search
     */
    private bool $caseInsensitive;

    /**
     * Constructor
     *
     * @param  array  $texts  Array of texts to search
     * @param  bool  $caseInsensitive  Flag for case-insensitive search (default: true)
     */
    public function __construct(array $texts, bool $caseInsensitive = true)
    {
        $this->texts = $texts;
        $this->levenshteinDistance = new LevenshteinDistance();
        $this->caseInsensitive = $caseInsensitive;
    }

    /**
     * Perform fuzzy search
     *
     * @param  string  $query  Search query
     * @param  int  $maxDistance  Maximum Levenshtein distance (default: 2)
     * @return array Array of matching texts
     */
    public function search(string $query, int $maxDistance = 2): array
    {
        // Convert query to lowercase if case-insensitive
        $query = $this->caseInsensitive ? strtolower($query) : $query;

        // Initialize results array
        $results = [];

        // Iterate through texts
        foreach ($this->texts as $text) {
            // Convert text to lowercase if case-insensitive
            $textLowercase = $this->caseInsensitive ? strtolower($text) : $text;

            // Calculate Levenshtein distance
            $distance = $this->levenshteinDistance->calculate($query, $textLowercase);

            // Check if distance is within max distance
            if ($distance <= $maxDistance) {
                // Store original text and distance
                $results[] = ['text' => $text, 'distance' => $distance];
            }
        }

        // Sort results by distance
        usort($results, function ($a, $b) {
            return $a['distance'] - $b['distance'];
        });

        // Return sorted results
        return array_column($results, 'text');
    }

    /**
     * Get the best match from the search results
     *
     * @param  array  $results  Search results
     * @return string Best match
     */
    public function getBestMatch(array $results): string
    {
        $bestMatch = '';
        $minDistance = PHP_INT_MAX;

        foreach ($results as $result) {
            if ($result['distance'] < $minDistance) {
                $minDistance = $result['distance'];
                $bestMatch = $result['text'];
            }
        }

        return $bestMatch;
    }
}
