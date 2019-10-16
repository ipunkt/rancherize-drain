<?php namespace RancherizeDrain\Writer;

use Rancherize\Blueprint\Infrastructure\Service\ExtraInformationNotFoundException;
use Rancherize\Blueprint\Infrastructure\Service\Service;
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
	 * @var &string
	 */
	protected $dockerContent;

	/**
	 * @var &string
	 */
	protected $rancherContent;

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

	/**
	 * @param mixed $dockerContent
	 * @return Writer
	 */
	public function setDockerContent( $dockerContent ) {
		$this->dockerContent = $dockerContent;
		return $this;
	}

	/**
	 * @param mixed $rancherContent
	 * @return Writer
	 */
	public function setRancherContent( $rancherContent ) {
		$this->rancherContent = $rancherContent;
		return $this;
	}

	protected function writeDrainTimeout(DrainExtraInformation $information) {
		$this->rancherContent['drain_timeout_ms'] = (int)$information->getIdentifier();
	}

}