<?php

declare(strict_types=1);

namespace J7\PowerWebinar\Shared\Cache;

use J7\PowerWebinar\Shared\Cache\Attributes\Transient;
use J7\PowerWebinar\Plugin;

/**
 * Cache Base
 * TODO 之後支援 object cache
 */
class CacheBase {

	/** @var string $prefix Prefix*/
	protected string $prefix = '';

	/** @var string $transient_key Transient Key */
	protected readonly string $transient_key;

	/** @var bool $disable_cache 是否禁用 Cache */
	private readonly bool $disable_cache;

	/**
	 * Constructor
	 *
	 * @param string $method_name 方法名稱
	 * @param string $params_key 請求參數的唯一key
	 */
	public function __construct( private readonly string $method_name, protected readonly string $params_key = '' ) {
		$this->transient_key = $this->prefix . $this->params_key;

		$this->disable_cache = 'local' === \wp_get_environment_type();
	}

	/**
	 * @return mixed 取得快取結果
	 * @throws \Exception 其他異常
	 */
	public function get(): mixed {
		if ($this->disable_cache) {
			return null;
		}

		$instance = $this->get_attribute_instance(Transient::class);

		if (!$instance) {
			return null;
		}

		$cached_data = \get_transient( $this->transient_key);

		if (false !== $cached_data) {
			return $cached_data;
		}

		return null;
	}

	/**
	 * 取得屬性實例
	 *
	 * @param string $attr_class 類別名稱
	 *
	 * @return mixed
	 * @throws \ReflectionException 反射異常
	 * @throws \Exception 屬性不存在異常
	 */
	protected function get_attribute_instance( string $attr_class ): mixed {
		$reflection_method = $this->get_reflection_method();
		$attributes        = $reflection_method->getAttributes( $attr_class );
		$attribute         = reset($attributes);
		return $attribute ? $attribute->newInstance() : null;
	}

	/**
	 * 取得反射方法
	 *
	 * @return \ReflectionMethod
	 * @throws \ReflectionException 反射異常
	 */
	protected function get_reflection_method(): \ReflectionMethod {
		$plugin = Plugin::instance();
		if (!isset($plugin->reflection_containers[ $this->method_name ])) {
			$plugin->reflection_containers[ $this->method_name ] = new \ReflectionMethod(  $this->method_name );
		}
		return $plugin->reflection_containers[ $this->method_name ];
	}

	/**
	 * @param mixed $data 儲存快取
	 *
	 * @return void
	 * @throws \ReflectionException 反射異常
	 */
	public function set( mixed $data ): void {
		if ($this->disable_cache) {
			return;
		}

		$instance = $this->get_attribute_instance(Transient::class);

		if (!$instance) {
			return;
		}

		\set_transient( $this->transient_key, $data, $instance->expiration );
	}

	/**
	 * @return void 刪除快取
	 */
	public function delete(): void {
		\delete_transient( $this->transient_key );
	}
}
