<?php

namespace Core;

namespace J7\PowerWebinar\Domains\FluentForm\Core;

use J7\PowerWebinar\Domains\FluentForm\MyAwesomeFFElement;

class ExtendFormFieldHooks {
    use \J7\WpUtils\Traits\SingletonTrait;
    
    public function __construct() {
        \add_action( 'fluentform/loaded', [ $this, 'extend_custom_filed' ] );
    }
    
    public function extend_custom_filed() {
        new MyAwesomeFFElement();
    }
}