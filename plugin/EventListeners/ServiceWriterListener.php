<?php namespace RancherizeDrain\EventListeners;

use Rancherize\Blueprint\Infrastructure\Service\Events\ServiceWriterServicePreparedEvent;
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
	 * @param ServiceWriterServicePreparedEvent $event
	 */
	public function servicePrepared(ServiceWriterServicePreparedEvent $event) {
		$dockerContent = $event->getDockerContent();
		$rancherContent = $event->getRancherContent();

		$this->writer->setDockerContent($dockerContent)
			->setRancherContent($rancherContent)
			->write();

		$event->setDockerContent($dockerContent);
		$event->setRancherContent($rancherContent);
	}
}