<?php namespace RancherizeTraefikDrain\EventListeners;

use Rancherize\Blueprint\Events\MainServiceBuiltEvent;
use RancherizeTraefikDrain\Parser\DrainParser;

/**
 * Class MainServiceBuiltListener
 * @package RancherizeTraefikDrain\EventListeners
 */
class MainServiceBuiltListener {
	/**
	 * @var DrainParser
	 */
	private $drainParser;

	/**
	 * MainServiceBuiltListener constructor.
	 * @param DrainParser $drainParser
	 */
	public function __construct( DrainParser $drainParser) {
		$this->drainParser = $drainParser;
	}

	/**
	 * @param MainServiceBuiltEvent $event
	 */
	public function mainServiceBuilt(MainServiceBuiltEvent $event) {
		$this->drainParser->parse($event->getMainService(), $event->getEnvironmentConfiguration());
	}

}