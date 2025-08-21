<?php
namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs;

use J7\WpUtils\Classes\DTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\WebinarTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\WebinarIdTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits\WebinarHashTrait;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Enums\ScheduleEnum;

/**
 * Webinar DTO
 */
class WebinarDTO extends DTO {
	use WebinarIdTrait;
	use WebinarHashTrait;
	use WebinarTrait;

	/** @var array<string>|'ALL' 必填參數  */
	protected array|string $require_properties = 'ALL';

	/**
	 * @return void
	 * @throws \Exception 缺少參數
	 */
	protected function validate(): void {
		parent::validate();
		// schedule 必須是 ScheduleEnum::value 的陣列
		array_map( [ ScheduleEnum::class, 'from' ], $this->schedules);
	}
}
