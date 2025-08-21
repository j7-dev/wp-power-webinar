<?php

namespace J7\PowerWebinar\Domain\WebinarJam\Interfaces;

use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostWebinarListRequestDTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostWebinarListResponseDTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostRegisterRequestDTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostRegisterResponseDTO;

interface IWebinarJamService {

	/**
	 * @param PostWebinarListRequestDTO $params
	 *
	 * @return PostWebinarListResponseDTO
	 */
	public function get_webinars( PostWebinarListRequestDTO $params ): PostWebinarListResponseDTO;

	// public function get_webinar(  ): array;

	public function register_webinar( PostRegisterRequestDTO $params ): PostRegisterResponseDTO;

	// public function get_registrants(  ): array;
	// public function get_webinar(  ): array;
	// public function get_webinar(  ): array;
}
