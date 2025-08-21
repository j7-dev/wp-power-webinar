<?php

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs;

use J7\WpUtils\Classes\DTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\ApiBaseTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\WebinarIdTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\WebinarScheduleIdTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\UserTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\UserIpTrait;

/**
 * PostRegisterRequestDTO
 *
 * @ref https://support.webinarjam.com/support/solutions/articles/153000168626-register-a-person-to-a-specific-webinar-webinarjam-api-
 */
class PostRegisterRequestDTO extends DTO {
	use ApiBaseTrait;
	use WebinarIdTrait;
	use WebinarScheduleIdTrait;
	use UserTrait;
	use UserIpTrait;

	/** @var array<string>|'ALL' 必填參數 */
	protected array|string $require_properties = [
		'api_key',
		'webinar_id',
		'first_name',
		'email',
		'schedule',
	];
}
