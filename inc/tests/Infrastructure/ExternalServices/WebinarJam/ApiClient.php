<?php

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam;

use J7\WpUtils\Traits\SingletonTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\GetWebinarListResponseDTOTest;

final class ApiClient {
	use SingletonTrait;

	public function get_webinars() {
		$config   = ApiConfig::instance();
		$response = $this->requester( 'webinars', [ 'api_key' => $config->api_key ], 'POST' );
		return $response;
	}

	private function requester( string $endpoint, array $params = [], string $method = 'GET' ): object {

		$config = ApiConfig::instance();
		$url    = "{$config->api_url}/{$endpoint}";
		$body   = $params;
		if ( 'GET' === $method ) {
			$url  = \add_query_arg( $params, $url );
			$body = null;
		}
		$result = \wp_remote_request(
			$url,
			[
				'method'   => $method,
				'timeout'  => 30,
				'blocking' => true,
				'body'     => $body,
					// 'headers'  => $headers,
			]
		);

		if ( \is_wp_error( $result ) ) {
			throw new \Exception( $result->get_error_message() );
		}
		$body = \wp_remote_retrieve_body( $result );
		return \json_decode( $body, true, 512, JSON_THROW_ON_ERROR );
	}

	public function register_webinar() {}
}
