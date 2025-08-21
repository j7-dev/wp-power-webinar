<?php

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs;

use J7\WpUtils\Classes\DTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\StatusTrait;



/**
 * PostRegisterResponseDTO
 *
 * @ref https://support.webinarjam.com/support/solutions/articles/153000168626-register-a-person-to-a-specific-webinar-webinarjam-api-
 */
class PostRegisterResponseDTO extends DTO {
	use StatusTrait;

	/** @var RegisteredUserDTO  $user 用戶報名資料 */
	public RegisteredUserDTO $user;

	/**
	 * @param array $response API 回傳的原始資料
	 * @return static
	 * @throws \Exception DTO Error
	 */
	public static function from( array $response ): static {
		return new static(
			[
				'status' => $response['status'] ?? '',
				'user'   => RegisteredUserDTO::parse( $response['user']),
			]
		);
	}
}
