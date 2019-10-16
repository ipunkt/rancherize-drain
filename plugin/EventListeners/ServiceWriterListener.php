<?php namespace RancherizeDrain\EventListeners;

use Rancherize\Blueprint\Infrastructure\Service\Events\ServiceWriterServicePreparedEvent;
use Rancherize\Blueprint\Infrastructure\Service\Events\ServiceWriterWritePreparedEvent;
use RancherizeDrain\Writer\Writer;

/**
 * Class ServiceWriterListener
 * @package RancherizeTraefikDrain\EventListeners
 */
class ServiceWriterListener {
	/**
	 * @var Writer
	 */
	private $writer;

	/**
	 * ServiceWriterListener constructor.
	 * @param Writer $writer
	 */
	public function __construct( Writer $writer) {
		$this->writer = $writer;
	}

    /**
     * @param ServiceWriterWritePreparedEvent $event
     */
	public function servicePrepared(ServiceWriterWritePreparedEvent $event) {

		$this->writer
            ->setService($event->getService())
            ->setDefinition($event->getDefinition())
			->write();
	}
}