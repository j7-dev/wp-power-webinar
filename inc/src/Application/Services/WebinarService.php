<?php

namespace J7\PowerWebinar\Application\Services;

use J7\PowerWebinar\Domain\Webinar\Contracts\IWebinarService;
use J7\PowerWebinar\Shared\Cache\Attributes\Transient;
use J7\PowerWebinar\Shared\Cache\CacheBase;
use J7\WpUtils\Classes\DTO;
use J7\PowerWebinar\Domain\Webinar\Contracts\IApiClient;

/**
 * Webinar 服務
 * 底層可能可以串接不同的 Webinar Provider (例如 WebinarJam, EverWebinar, WebinarKit 等)
 *
 * 功能
 * 1. 取得 webinar 列表
 * 2. 報名 webinar
 *
 * TODO
 * return 的 DTO 應該要有固定格式
 */
final class WebinarService implements IWebinarService {


	/**
	 * Constructor
	 *
	 * @param IApiClient $api_client 注入 Webinar Provider 的 ApiClient
	 */
	public function __construct( private readonly IApiClient $api_client ) {
	}

	/**
	 * 取得 Webinar 列表
	 *
	 * @param DTO $params 請求參數
	 * @return array 回傳 Webinar 列表
	 * @throws \Exception 請求失敗時拋出例外
	 */
	#[Transient(HOUR_IN_SECONDS)]
	public function get_webinars( DTO $params ): array {
		$cache       = new CacheBase( __METHOD__, $params->to_unique_key() );
		$cached_data = $cache->get();
		if ($cached_data) {
			return $cached_data;
		}
		$webinars = $this->api_client->get_webinars($params);
		$cache->set( array_map( static fn( $w ) => $w->to_array(), $webinars) );
		return $webinars;
	}

	/**
	 * @param \J7\WpUtils\Classes\DTO $params 請求參數
	 *
	 * @return \J7\WpUtils\Classes\DTO
	 * @throws \Exception 請求失敗時拋出例外
	 */
	public function register_webinar( DTO $params ): DTO {
		return $this->api_client->register_webinar($params);
	}
}
