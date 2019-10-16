<?php namespace RancherizeTraefikDrain;

use Rancherize\Blueprint\Infrastructure\Service\ServiceExtraInformation;

/**
 * Class DrainExtraInformation
 * @package RancherizeTraefikDrain
 */
class DrainExtraInformation implements ServiceExtraInformation {

	const IDENTIFIER = 'drain';

	/**
	 * @var int
	 */
	protected $timeout = 0;

	/**
	 * @return mixed
	 */
	public function getIdentifier() {
		return self::IDENTIFIER;
	}

	/**
	 * @param int $timeout
	 * @return DrainExtraInformation
	 */
	public function setTimeout( int $timeout ): DrainExtraInformation {
		$this->timeout = $timeout;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getTimeout(): int {
		return $this->timeout;
	}
}