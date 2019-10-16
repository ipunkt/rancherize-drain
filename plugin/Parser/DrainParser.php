<?php namespace RancherizeDrain\Parser;

use Rancherize\Blueprint\Infrastructure\Service\Service;
use Rancherize\Configuration\Configuration;
use RancherizeDrain\DrainExtraInformation;

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
	 * @param Service $service
	 * @param Configuration $configuration
	 */
	public function parse( Configuration $configuration ) {
		if( !$configuration->has('drain') )
			return;

        $isDisabled = !$configuration->get('drain.enable', true);
        if( $isDisabled )
            return;


		$timeout = (int)$configuration->get('drain.timeout', 30);

		$information = new DrainExtraInformation();
		$information->setTimeout($timeout);

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