<?php namespace RancherizePublishRancher;

use Rancherize\Blueprint\PublishUrls\PublishUrlsYamlWriter\PublishUrlsYamlWriter;
use Rancherize\Blueprint\PublishUrls\PublishUrlsYamlWriter\Traefik\V2\V2TraefikPublishUrlsYamlWriterVersion;
use Rancherize\Plugin\ProviderTrait;

/**
 * Class RancherPublishProvider
 */
class RancherPublishProvider implements \Rancherize\Plugin\Provider {

	use ProviderTrait;

	/**
	 */
	public function register() {
		$this->container['publish-urls-yaml-writer.traefik-rancher.2'] = function($c) {
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