<?php

namespace J7\PowerWebinar\Domain\Webinar\Contracts;

use J7\WpUtils\Classes\DTO;

interface IWebinarService {

	/**
	 * @param DTO $params 請求參數
	 *
	 * @return array
	 */
	public function get_webinars( DTO $params ): array;


	/**
	 * @param DTO $params 請求參數
	 *
	 * @return DTO
	 */
	public function register_webinar( DTO $params ): DTO;
}
