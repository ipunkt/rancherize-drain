<?php namespace RancherizeDrain;

use Rancherize\Blueprint\Events\MainServiceBuiltEvent;
use Rancherize\Blueprint\Infrastructure\Service\Events\ServiceWriterServicePreparedEvent;
use Rancherize\Plugin\Provider;
use Rancherize\Plugin\ProviderTrait;
use RancherizeDrain\EventListeners\MainServiceBuiltListener;
use RancherizeDrain\EventListeners\ServiceWriterListener;
use RancherizeDrain\Parser\DrainParser;
use RancherizeDrain\Writer\Writer;
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

		$this->container[Writer::class] = function() {
		    return new Writer();
        };

        $this->container[ServiceWriterListener::class] = function($c) {
            return new ServiceWriterListener($c[Writer::class]);
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
		$event->addListener(MainServiceBuiltEvent::NAME, [$eventListener, 'mainServiceBuilt']);
		$event->addListener(ServiceWriterServicePreparedEvent::NAME, 'servicePrepared');
	}
}