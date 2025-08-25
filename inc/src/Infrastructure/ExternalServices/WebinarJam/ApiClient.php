<?php

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam;

use J7\WpUtils\Traits\SingletonTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostWebinarListRequestDTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostWebinarListResponseDTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostRegisterRequestDTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostRegisterResponseDTO;
use J7\PowerWebinar\Domain\Webinar\Contracts\IApiClient;
use J7\WpUtils\Classes\DTO;
use J7\PowerWebinar\Plugin;

/**
 * WebinarJam API 客戶端
 * 情求參數 DTO，進到方法會被 Mapper 為 RequestDTO
 */
final class ApiClient implements IApiClient {
	use SingletonTrait;

	/**
	 * 取得 Webinar 列表
	 *
	 * @param DTO $params 請求 DTO
	 * @return array 回傳 Webinar 列表 DTO
	 * @throws \Exception 請求失敗時拋出例外
	 */
	public function get_webinars( DTO $params ): array {
		try {
			$request_dto = $params->to_dto(PostWebinarListRequestDTO::class);
			$response    = $this->requester( 'webinars', $request_dto->to_array(), 'POST' );
			return PostWebinarListResponseDTO::from( $response)->webinars;
		} catch (\Exception $e) {
			Plugin::logger(
				$e->getMessage(),
				'error',
				[
					'params' => $params->to_array(),
				]
				);
			return [];
		}
	}

	/**
	 * 發送 API 請求
	 *
	 * @param string               $endpoint API 路徑
	 * @param array<string, mixed> $params 請求參數
	 * @param string               $method HTTP 方法 (預設為 GET)
	 * @return array 回傳 API 回應物件
	 * @throws \Exception 請求失敗時拋出例外
	 */
	private function requester( string $endpoint, array $params = [], string $method = 'GET' ): array {
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

	/**
	 * 報名 Webinar
	 *
	 * @param DTO $params 報名請求 DTO
	 * @return PostRegisterResponseDTO 報名回應 DTO
	 * @throws \Exception 請求失敗時拋出例外
	 */
	public function register_webinar( DTO $params ): PostRegisterResponseDTO {
		$request_dto = $params->to_dto(PostRegisterRequestDTO::class);
		$response    = $this->requester( 'register', $request_dto->to_array(), 'POST' );
		return PostRegisterResponseDTO::from( $response );
	}
}
