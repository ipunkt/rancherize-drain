<?php namespace RancherizePublishRancher\YamlWriters\V2;

use Rancherize\Blueprint\PublishUrls\PublishUrlsExtraInformation\PublishUrlsExtraInformation;
use Rancherize\Blueprint\PublishUrls\PublishUrlsYamlWriter\PublishUrlsYamlWithPartWriters;
use RancherizePublishRancher\YamlWriters\PartWriters\TraefikRancherEnableWriter;
use RancherizePublishRancher\YamlWriters\PartWriters\TraefikRancherPortWriter;
use RancherizePublishRancher\YamlWriters\PartWriters\TraefikRancherRuleWriter;

/**
 * Class V2TraefikRancherYamlWriterVersion
 * @package RancherizePublishRancher\YamlWriters\V2
 */
class V2TraefikRancherYamlWriterVersion extends PublishUrlsYamlWithPartWriters {

	public function __construct() {
		$this->addPartWriter( new TraefikRancherEnableWriter() );
		$this->addPartWriter( new TraefikRancherPortWriter() );
		$this->addPartWriter( new TraefikRancherRuleWriter() );
	}

	/**
	 * @param PublishUrlsExtraInformation $extraInformation
	 * @param array $dockerService
	 */
	public function write( PublishUrlsExtraInformation $extraInformation, array &$dockerService ) {

		if( !array_key_exists('labels', $dockerService) )
			$dockerService['labels'] = [];

		parent::write($extraInformation, $dockerService);

	}
}