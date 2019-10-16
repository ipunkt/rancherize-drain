<?php namespace RancherizeDrain\SuffixConverter;

/**
 * Class TimeSuffixConverter
 * @package RancherizeDrain\SuffixConverter
 */
class TimeToMSSuffixConverter extends SuffixConverter
{

    public function __construct() {
        parent::__construct();

        $this->setSuffix('ms', function($value) {
            return $value;
        });

        $secondsToMs = function ($value) {
            return $value * 1000;
        };
        $this->setSuffix('s', $secondsToMs);
        $this->setDefaultConversion($secondsToMs);

        $this->setSuffix('m', function($value) {
            return $value * 1000 * 60;
        });

    }

}