<?php

declare(strict_types=1);

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam;

use J7\WpUtils\Traits\SingletonTrait;

/**
 * Class ApiConfig
 *
 * Configuration for WebinarJam API
 */
final class ApiConfig {
	use SingletonTrait;

	/** @var string WebinarJam base api url */
	public readonly string $api_url;

	/** @var string API key for authentication */
	public string $api_key;

	/** Constructor */
	public function __construct() {
		$this->api_url = 'https://api.webinarjam.com/webinarjam';
		// TODO api_key 要從 DB 拿
		$this->api_key = '9ae82a6c-e777-4c2c-b458-c9f72ecfccbb';
	}
}
