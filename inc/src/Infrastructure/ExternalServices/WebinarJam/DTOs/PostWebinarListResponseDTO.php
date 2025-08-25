<?php

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs;

use J7\WpUtils\Classes\DTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\StatusTrait;

/**
 * PostWebinarListResponseDTO
 *
 * @ref https://support.webinarjam.com/support/solutions/articles/153000168632-retrieve-a-full-list-of-all-webinars-published-in-your-account-webinarjam-api-
 */
class PostWebinarListResponseDTO extends DTO {
	use StatusTrait;

	/** @var array<WebinarDTO>  */
	public array $webinars;

	/** @var array<string>|'ALL' 必填參數  */
	protected array|string $require_properties = 'ALL';

	/**
	 * @param array $response API 回傳的原始資料
	 * @return static
	 * @throws \Exception DTO Error
	 */
	public static function from( array $response ): static {
		return new static(
			[
				'status'   => $response['status'] ?? '',
				'webinars' => array_map( [ WebinarDTO::class, 'parse' ], $response['webinars'] ?? [] ),
			]
			);
	}
}
