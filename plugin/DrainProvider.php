<?php namespace RancherizeDrain;

use Rancherize\Blueprint\Events\MainServiceBuiltEvent;
use Rancherize\Plugin\Provider;
use Rancherize\Plugin\ProviderTrait;
use RancherizeDrain\EventListeners\MainServiceBuiltListener;
use RancherizeDrain\Parser\DrainParser;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class RancherPublishProvider
 */
class DrainProvider implements Provider {

	use ProviderTrait;

	/**
	 */
	public function register() {
		$this->container[DrainParser::class] = function () {
			return new DrainParser();
		};

		$this->container[MainServiceBuiltListener::class] = function($c) {
			return new MainServiceBuiltListener($c[DrainParser::class]);
		};
	}

	/**
	 */
	public function boot() {
		/**
		 * @var MainServiceBuiltListener $eventListener
		 */
		$eventListener = $this->container[MainServiceBuiltListener::class];


		/**
		 * @var EventDispatcher $event
		 */
		$event = $this->container['event'];
		$event->addListener(MainServiceBuiltEvent::NAME, [$eventListener, 'mainServiceBuilt'], -1000);
	}
}