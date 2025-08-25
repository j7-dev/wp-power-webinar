<?php
declare(strict_types=1);
namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Shared;

use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\ApiConfig;
use J7\PowerWebinar\Shared\Http\Base;

/**
 * Class Http
 *
 * WebinarJam API HTTP 客戶端
 */
class Http extends Base {

	/**
	 * @param string $method_name API 方法名稱
	 * @param array  $params     請求參數
	 *
	 * @throws \ReflectionException 反射異常
	 */
	public function __construct( string $method_name, array $params = [] ) {
		$config        = ApiConfig::instance();
		$this->api_url = $config->api_url;

		parent::__construct(
			$method_name,
			$params
		);
	}
}
