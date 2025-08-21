<?php

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits;

trait WebinarTrait {
	/** @var string Webinar Name | Webinar名稱（私有） */
	public string $name;

	/** @var string Webinar Title | Webinar標題（公開） */
	public string $title;

	/** @var string Webinar Description | Webinar描述 */
	public string $description;

	/** @var string|null Webinar Type | Webinar型態（系列、單場、隨時、即時） */
	public string|null $type;

	/** @var array<string> Schedule::value[] Webinar Schedules | Webinar排程陣列 */
	public array $schedules;

	/** @var string Webinar Timezone | Webinar時區 */
	public string $timezone;
}
