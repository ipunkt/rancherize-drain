<?php namespace RancherizeDrain\SuffixConverter;

use Closure;

/**
 * Class SuffixConverter
 * @package RancherizeDrain\SuffixConverter
 */
class SuffixConverter
{

    /**
     * @var array
     */
    protected $suffixes = [];

    /**
     * @var Closure
     */
    protected $defaultConversion;

    public function __construct() {
        $this->defaultConversion = function($value) {
            return $value;
        };
    }

    public function apply($target)
    {
        foreach($this->suffixes as $suffix => $conversion) {

            $matches = [];
            if( preg_match("~(.*)${suffix}$~", $target, $matches) !== 1 )
                continue;

            return $conversion( $matches[1] );
        }

        $defaultConversion = $this->defaultConversion;
        return $defaultConversion($target);
    }


    protected function setSuffix($suffix, Closure $conversion)
    {
        $this->suffixes[$suffix] = $conversion;
    }

    protected function setDefaultConversion(Closure $conversion)
    {
        $this->defaultConversion = $conversion;
    }
}