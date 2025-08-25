<?php

declare(strict_types=1);

namespace J7\PowerWebinar\Shared\Http;

use J7\PowerWebinar\Shared\Http\Attributes\Route;
use J7\PowerWebinar\Plugin;

/**
 * Http Base
 */
abstract class Base {

	/** @var string Api base url */
	protected string $api_url;

	/** @var array Headers */
	protected array $headers = [];


	/**
	 * Constructor
	 *
	 * @param string $method_name 方法名稱
	 * @param array  $params 請求參數
	 * @throws \ReflectionException 反射異常
	 */
	public function __construct( private readonly string $method_name, protected readonly array $params = [] ) {
		$plugin = Plugin::instance();
		if (!isset($plugin->reflection_containers[ $method_name ])) {
			$plugin->reflection_containers[ $method_name ] = new \ReflectionMethod(  $method_name );
		}
	}

	/**
	 * @return array 回傳結果
	 * @throws \JsonException JSON 解碼異常
	 * @throws \Exception 其他異常
	 */
	public function process(): array {
		$plugin            = Plugin::instance();
		$reflection_method = $plugin->reflection_containers[ $this->method_name ];
		$attributes        = $reflection_method->getAttributes(Route::class);
		$attribute         = reset($attributes);
		$instance          = $attribute ? $attribute->newInstance() : null;
		if (!$instance) {
			throw new \Exception("Route attribute not found on method $this->method_name");
		}

		$method = $instance->method;

		$url  = "{$this->api_url}/{$instance->endpoint}";
		$body = $this->params;
		if ( 'GET' === strtoupper($method) ) {
			$url  = \add_query_arg( $this->params, $url );
			$body = null;
		}
		$result = \wp_remote_request(
			$url,
			[
				'method'   => $method,
				'timeout'  => 30,
				'blocking' => true,
				'body'     => $body,
				'headers'  => $this->headers,
			]
		);

		if ( \is_wp_error( $result ) ) {
			throw new \Exception( $result->get_error_message() );
		}
		$body = \wp_remote_retrieve_body( $result );
		return \json_decode( $body, true, 512, JSON_THROW_ON_ERROR );
	}
}
