<?php namespace RancherizePublishRancher;

use Rancherize\Blueprint\PublishUrls\PublishUrlsYamlWriter\PublishUrlsYamlWriter;
use Rancherize\Plugin\Provider;
use Rancherize\Plugin\ProviderTrait;
use RancherizePublishRancher\YamlWriters\V2\V2TraefikRancherYamlWriterVersion;

/**
 * Class RancherPublishProvider
 */
class RancherPublishProvider implements Provider {

	use ProviderTrait;

	/**
	 */
	public function register() {
		$this->container['publish-urls-yaml-writer.traefik-rancher.2'] = function($c) {
			return new V2TraefikRancherYamlWriterVersion();
		};
	}

	/**
	 */
	public function boot() {
		/**
		 * @var PublishUrlsYamlWriter $yamlWriter
		 */
		$yamlWriter = $this->container['publish-urls-yaml-writer'];

		$yamlWriter->setDefaultType('traefik-rancher');
	}
}