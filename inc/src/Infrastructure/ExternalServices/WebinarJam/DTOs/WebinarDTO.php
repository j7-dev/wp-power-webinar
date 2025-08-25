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
	 * 轉換為選項格式
	 *
	 * @return array{value: string, label: string}
	 */
	public function to_option(): array {
		return [
			'value' => $this->webinar_id,
			'label' => $this->name,
		];
	}
}
