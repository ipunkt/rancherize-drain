<?php namespace RancherizePublishRancher;

use Rancherize\Blueprint\PublishUrls\PublishUrlsYamlWriter\PublishUrlsYamlWriter;

/**
 * Class RancherPublishProvider
 */
class RancherPublishProvider implements \Rancherize\Plugin\Provider {

	use \Rancherize\Plugin\ProviderTrait;

	/**
	 */
	public function register() {
		$this->container['publish-urls-yaml-writer.traefik-rancherl.2'] = function($c) {
			return new V2TraefikPublishUrlsYamlWriterVersion();
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