<?php

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Enums;

enum ScheduleEnum: string {

	case SERIES_OF_PRESENTATIONS = 'Series of presentations';
	case SINGLE_PRESENTATION     = 'Single presentation';
	case ALWAYS_ON               = 'Always on';
	case RIGHT_NOW               = 'Right now';
}
