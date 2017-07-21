<?php namespace RancherizePublishRancher\YamlWriters\PartWriters;

use Rancherize\Blueprint\PublishUrls\PublishUrlsExtraInformation\PublishUrlsExtraInformation;
use Rancherize\Blueprint\PublishUrls\PublishUrlsYamlWriter\PartWriter\PartWriter;

/**
 * Class TraefikRancherPriorityWriter
 * @package RancherizePublishRancher\YamlWriters\PartWriters
 */
class TraefikRancherPriorityWriter implements PartWriter {

	/**
	 * @param PublishUrlsExtraInformation $extraInformation
	 * @param array $dockerService
	 */
	public function write( PublishUrlsExtraInformation $extraInformation, array &$dockerService ) {
		$priority = $extraInformation->getPriority();

		$dockerService['labels']['traefik.frontend.priority'] = $priority;
	}
}