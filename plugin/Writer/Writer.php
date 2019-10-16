<?php namespace RancherizeDrain\Writer;

use Rancherize\Blueprint\Infrastructure\Service\ExtraInformationNotFoundException;
use Rancherize\Blueprint\Infrastructure\Service\Service;
use Rancherize\Blueprint\Infrastructure\Service\ServiceYamlDefinition;
use RancherizeDrain\DrainExtraInformation;

/**
 * Class Writer
 * @package RancherizeTraefikDrain\Writer
 */
class Writer {

	/**
	 * @var Service
	 */
	protected $service;

    /**
     * @var ServiceYamlDefinition
     */
    protected $definition;

    public function write() {
		try {
			$information = $this->service->getExtraInformation(DrainExtraInformation::IDENTIFIER);
		} catch(ExtraInformationNotFoundException $e) {
			return;
		}

		$isDrainInformation = $information instanceof DrainExtraInformation;
		if( !$isDrainInformation )
			return;

		/**
		 * @var DrainExtraInformation $information
		 */

		$this->writeDrainTimeout($information);
	}

	/**
	 * @param Service $service
	 * @return Writer
	 */
	public function setService( Service $service ): Writer {
		$this->service = $service;
		return $this;
	}

	protected function writeDrainTimeout(DrainExtraInformation $information) {
		$this->definition->rancherComposeEntry['drain_timeout_ms'] = (int)$information->getTimeout();
	}

    /**
     * @param ServiceYamlDefinition $definition
     * @return Writer
     */
    public function setDefinition(ServiceYamlDefinition $definition)
    {
        $this->definition = $definition;
        return $this;
    }

}