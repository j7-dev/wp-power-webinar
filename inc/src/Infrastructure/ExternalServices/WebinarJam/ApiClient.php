<?php

declare(strict_types=1);

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam;

use J7\WpUtils\Traits\SingletonTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostWebinarListRequestDTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostWebinarListResponseDTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostRegisterRequestDTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostRegisterResponseDTO;
use J7\PowerWebinar\Domain\Webinar\Contracts\IApiClient;
use J7\WpUtils\Classes\DTO;
use J7\PowerWebinar\Plugin;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Shared\Http;
use J7\PowerWebinar\Shared\Http\Attributes\Route;

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
	#[Route('POST', 'webinars')]
	public function get_webinars( DTO $params ): array {
		try {
			/** @var PostWebinarListRequestDTO $request_dto */
			$request_dto = $params->to_dto(PostWebinarListRequestDTO::class);
			$response    = ( new Http(__METHOD__, $request_dto->to_array() ) )->process();
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
	 * 報名 Webinar
	 *
	 * @param DTO $params 報名請求 DTO
	 * @return PostRegisterResponseDTO 報名回應 DTO
	 * @throws \Exception 請求失敗時拋出例外
	 */
	#[Route('POST', 'register')]
	public function register_webinar( DTO $params ): PostRegisterResponseDTO {
		$request_dto = $params->to_dto(PostRegisterRequestDTO::class);
		$response    = ( new Http(__METHOD__, $request_dto->to_array()) )->process();
		return PostRegisterResponseDTO::from( $response );
	}
}
