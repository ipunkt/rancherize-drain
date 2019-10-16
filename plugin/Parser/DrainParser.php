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
	 * @param Service $service
	 * @param Configuration $configuration
	 */
	public function parse( Service $service, Configuration $configuration ) {
		if( !$configuration->has('drain') )
			return;

		$timeout = (int)$configuration->get('drain.timeout', 30);

		$information = new DrainExtraInformation();
		$information->setTimeout($timeout);

		$service->addExtraInformation($information);
	}

}