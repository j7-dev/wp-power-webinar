<?php

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs;

use J7\WpUtils\Classes\DTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\ApiBaseTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\ApiConfig;

/**
 * PostWebinarListRequestDTO
 *
 * @ref https://support.webinarjam.com/support/solutions/articles/153000168632-retrieve-a-full-list-of-all-webinars-published-in-your-account-webinarjam-api-
 */
class PostWebinarListRequestDTO extends DTO {
	use ApiBaseTrait;

	/** @var array<string>|'ALL' 必填參數  */
	protected array|string $require_properties = 'ALL';

	/**
	 * @return static
	 * @throws \Exception DTO Error
	 */
	public static function instance(): static {
		return new static(
			[
				'api_key' => ApiConfig::instance()->api_key,
			]
			);
	}
}
