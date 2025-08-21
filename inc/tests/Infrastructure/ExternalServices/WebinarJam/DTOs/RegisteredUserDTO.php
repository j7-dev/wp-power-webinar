<?php

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs;

use J7\WpUtils\Classes\DTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\WebinarIdTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\WebinarHashTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\WebinarScheduleIdTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\UserTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\UserPasswordTrait;

/**
 * RegisteredUserDTO
 *
 * @ref https://support.webinarjam.com/support/solutions/articles/153000168626-register-a-person-to-a-specific-webinar-webinarjam-api-
 */
class RegisteredUserDTO extends DTO {
	use WebinarIdTrait;
	use WebinarHashTrait;
	use UserTrait;
	use UserPasswordTrait;
	use WebinarScheduleIdTrait;

	/** @var string  Webinar 日期 & 時間*/
	public string $date;
	/** @var string  Webinar 時區 */
	public string $timezone;
	/** @var string  Webinar Live Room URL */
	public string $live_room_url;
	/** @var string Replay Room URL */
	public string $replay_room_url;
	/** @var string  Registration Success URL */
	public string $thank_you_url;

	/** @var array<string>|'ALL' 必填參數  */
	protected array|string $require_properties = [
		'webinar_id',
		'webinar_hash',
		'user_id',
		'first_name',
		'email',
		'schedule',
		'date',
		'timezone',
		'live_room_url',
		'replay_room_url',
		'thank_you_url ',
	];
}
