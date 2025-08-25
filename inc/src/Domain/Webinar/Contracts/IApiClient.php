<?php

namespace J7\PowerWebinar\Domain\Webinar\Contracts;

use J7\WpUtils\Classes\DTO;

interface IApiClient {

	/**
	 * @param DTO $params 請求參數
	 *
	 * @return array
	 */
	public function get_webinars( DTO $params ): array;

	// public function get_webinar(  ): array;

	/**
	 * @param DTO $params 請求參數
	 *
	 * @return DTO
	 */
	public function register_webinar( DTO $params ): DTO;

	// public function get_registrants(  ): array;
	// public function get_webinar(  ): array;
	// public function get_webinar(  ): array;
}
