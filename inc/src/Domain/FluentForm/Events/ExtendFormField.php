<?php

namespace Core;

namespace J7\PowerWebinar\Domain\FluentForm\Events;

class ExtendFormField {
	use \J7\WpUtils\Traits\SingletonTrait;

	public function __construct() {
		\add_action( 'fluentform/loaded', [ $this, 'extend_custom_filed' ] );
	}

	public function extend_custom_filed(): void {
		new FormField\MyAwesome();
	}
}
