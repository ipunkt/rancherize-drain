<?php namespace RancherizePublishRancher\YamlWriters\PartWriters;

use Rancherize\Blueprint\PublishUrls\PublishUrlsExtraInformation\PublishUrlsExtraInformation;
use Rancherize\Blueprint\PublishUrls\PublishUrlsYamlWriter\PartWriter\PartWriter;

/**
 * Class TraefikRancherRuleWriter
 * @package RancherizePublishRancher\YamlWriters\PartWriters
 */
class TraefikRancherRuleWriter implements PartWriter {

	/**
	 * @param PublishUrlsExtraInformation $extraInformation
	 * @param array $dockerService
	 */
	public function write( PublishUrlsExtraInformation $extraInformation, array &$dockerService ) {
		$rules = [ ];

		$hostname = $this->getHostname( $extraInformation );
		$hostRule = 'Host:'.$hostname;
		$rules[] = $hostRule;

		$prefixes = $this->buildPrefixes( $extraInformation );
		$prefixRule = 'PathPrefix:'.$prefixes;
		if( !empty($prefixes) )
			$rules[] = $prefixRule;

		$rule = implode(';', $rules );

		$dockerService['labels']['traefik.frontend.rule'] = $rule;
	}

	protected function getHostname(PublishUrlsExtraInformation $extraInformation) {
		$url = $extraInformation->getUrl();

		$fullPath = parse_url($url, PHP_URL_HOST);

		return $fullPath;
	}

	/**
	 * @param $extraInformation
	 * @return string
	 */
	private function buildPrefixes( PublishUrlsExtraInformation $extraInformation ) {
		$pathes = $extraInformation->getPathes();

		return implode(',', $pathes);
	}
}