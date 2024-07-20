<?php

namespace Designbycode\FuzzySearch;

class FuzzySearch {

    private $texts;
    private $levenshteinDistance;

    public function __construct(array $texts) {
        $this->texts = $texts;
        $this->levenshteinDistance = new LevenshteinDistance();
    }

    public function search($query, $maxDistance = 2): array
    {
        $query = strtolower($query); // Convert query to lowercase
        $results = array();
        foreach ($this->texts as $text) {
            $textLowercase = strtolower($text); // Convert text to lowercase
            $distance = $this->levenshteinDistance->calculate($query, $textLowercase);
            if ($distance <= $maxDistance) {
                $results[] = $text; // Store original text (with original case)
            }
        }
        return $results;
    }


}
