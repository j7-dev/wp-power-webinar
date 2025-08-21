<?php

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam;

use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\ApiConfig;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Attributes\HttpMethod;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Attributes\Endpoint;

abstract class ApiClientBase {

	public function request() {
		$config            = ApiConfig::instance();
		$reflection_method = new \ReflectionMethod( __CLASS__, __FUNCTION__);

		$methods   = $reflection_method->getAttributes( HttpMethod::class );
		$method    = reset( $methods )->value;
		$endpoints = $reflection_method->getAttributes( Endpoint::class );
		$endpoint  = reset( $endpoints )->value;

		return \wp_remote_request(
			"{$config->api_url}/{$endpoint}",
			[
				'method'  => $method,
				'timeout' => 30,
			]
			);
	}
}
