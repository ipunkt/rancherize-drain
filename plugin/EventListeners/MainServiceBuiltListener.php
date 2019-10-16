<?php namespace RancherizeDrain\EventListeners;

use Rancherize\Blueprint\Events\MainServiceBuiltEvent;
use RancherizeDrain\Parser\DrainParser;

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
		$this->drainParser
            ->setService( $event->getMainService() )
            ->parse( $event->getEnvironmentConfiguration() );
	}

}