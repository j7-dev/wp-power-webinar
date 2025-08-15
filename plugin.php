<?php
/**
 * Plugin Name:       Power Webinar | 讓學員可以透過 Fluent Form 直接報名 WebinarJam
 * Plugin URI:        https://github.com/j7-dev/wp-power-webinar
 * Description:       讓學員可以透過 Fluent Form 直接報名 WebinarJam
 * Version:           0.0.1
 * Requires at least: 5.7
 * Requires PHP:      8.1
 * Author:            J7
 * * Author URI:        https://github.com/j7-dev
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       power_webinar
 * Domain Path:       /languages
 * Tags: webinar, WebinarJam
 */

declare ( strict_types = 1 );

namespace J7\PowerWebinar;

if( \class_exists( 'J7\PowerWebinar\Plugin' ) ) {
    return;
}
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Class Plugin
 */
final class Plugin {
    use \J7\WpUtils\Traits\PluginTrait;
    use \J7\WpUtils\Traits\SingletonTrait;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->init(
            [
                'app_name'    => 'Power Webinar',
                'github_repo' => 'https://github.com/j7-dev/wp-power-webinar',
                'callback'    => [ Bootstrap::class, 'instance' ],
                'priority'    => 9,
                'lc'          => 'ZmFsc2',
            ]
        );
    }
}

Plugin::instance();
