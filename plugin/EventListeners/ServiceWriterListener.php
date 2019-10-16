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
	    var_dump('servicePrepared');
		$dockerContent = $event->getDockerContent();
		$rancherContent = $event->getRancherContent();

		$this->writer
            ->setService($event->getService())
            ->setDockerContent($dockerContent)
			->setRancherContent($rancherContent)
			->write();

		$event->setDockerContent($dockerContent);
		$event->setRancherContent($rancherContent);
	}
}