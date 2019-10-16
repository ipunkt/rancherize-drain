<?php namespace RancherizeDrain\Parser;

use Rancherize\Blueprint\Infrastructure\Service\Service;
use Rancherize\Configuration\Configuration;
use RancherizeDrain\DrainExtraInformation;
use RancherizeDrain\SuffixConverter\SuffixConverter;
use RancherizeDrain\SuffixConverter\TimeToMSSuffixConverter;

/**
 * Class DrainParser
 * @package RancherizeTraefikDrain\Parser
 */
class DrainParser {

    /**
     * @var Service
     */
    protected $service;
    /**
     * @var SuffixConverter
     */
    private $suffixConverter;

    /**
     * DrainParser constructor.
     * @param TimeToMSSuffixConverter $suffixConverter
     */
    public function __construct(TimeToMSSuffixConverter $suffixConverter) {
        $this->suffixConverter = $suffixConverter;
    }

	/**
	 * @param Service $service
	 * @param Configuration $configuration
	 */
	public function parse( Configuration $configuration ) {
		if( !$configuration->has('drain') ) {
            var_dump('drain not found');

            return;
        }

        $isDisabled = !$configuration->get('drain.enable', true);
        if( $isDisabled ) {
            var_dump('drain disabled');
            return;
        }


		$timeoutWithSuffix = (string)$configuration->get('drain.timeout', '30s');
        $timeoutInMs = $this->suffixConverter->apply($timeoutWithSuffix);

		$information = new DrainExtraInformation();
		$information->setTimeout($timeoutInMs);

		$this->service->addExtraInformation($information);
	}

    /**
     * @param Service $service
     * @return DrainParser
     */
    public function setService(Service $service): DrainParser
    {
        $this->service = $service;
        return $this;
    }

}