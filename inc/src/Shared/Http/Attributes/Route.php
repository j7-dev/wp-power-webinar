<?php

declare(strict_types=1);

namespace J7\PowerWebinar\Shared\Http\Attributes;

use Attribute;

/**
 * Route Attribute
 * 用於標註 API 路徑和 HTTP 方法
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Route {
	/**
	 * Constructor
	 *
	 * @params string $method HTTP 方法 (GET, POST, etc.)
	 *         string $endpoint API 路徑
	 */
	public function __construct( public string $method = 'GET', public string $endpoint = '' ) {}
}
