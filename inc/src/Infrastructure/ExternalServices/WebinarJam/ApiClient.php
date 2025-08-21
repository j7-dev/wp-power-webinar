<?php

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam;

use J7\WpUtils\Traits\SingletonTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostWebinarListRequestDTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostWebinarListResponseDTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostRegisterRequestDTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostRegisterResponseDTO;

/**
 * WebinarJam API 客戶端
 *
 * @package J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam
 */
final class ApiClient {
	// 使用 SingletonTrait 單例模式
	use SingletonTrait;

	/**
	 * 取得 Webinar 列表
	 *
	 * @param PostWebinarListRequestDTO $request_dto 請求 DTO
	 * @return PostWebinarListResponseDTO 回傳 Webinar 列表 DTO
	 * @throws \Exception 請求失敗時拋出例外
	 */
	public function get_webinars( PostWebinarListRequestDTO $request_dto ): PostWebinarListResponseDTO {
		$response = $this->requester( 'webinars', $request_dto->to_array(), 'POST' );
		return PostWebinarListResponseDTO::from( $response);
	}

	/**
	 * 發送 API 請求
	 *
	 * @param string               $endpoint API 路徑
	 * @param array<string, mixed> $params 請求參數
	 * @param string               $method HTTP 方法 (預設為 GET)
	 * @return object 回傳 API 回應物件
	 * @throws \Exception 請求失敗時拋出例外
	 */
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

	/**
	 * 報名 Webinar
	 *
	 * @param PostRegisterRequestDTO $request_dto 報名請求 DTO
	 * @return PostRegisterResponseDTO 報名回應 DTO
	 * @throws \Exception 請求失敗時拋出例外
	 */
	public function register_webinar( PostRegisterRequestDTO $request_dto ): PostRegisterResponseDTO {
		$response = $this->requester( 'register', $request_dto->to_array(), 'POST' );
		return PostRegisterResponseDTO::from( $response );
	}
}
