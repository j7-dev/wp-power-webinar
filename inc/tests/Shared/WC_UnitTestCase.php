<?php

namespace J7\PowerWebinarTests\Shared;


/**
 * WC_UnitTestCase
 *
 * 設計思想：
 * 1. 抽象出公用屬性，方便設定
 * 2. 預設已經先執行必要的生命週期，也可以自己添加
 * 3. 測試結束後，清除所有數據
 *  */
abstract class WC_UnitTestCase extends \WP_UnitTestCase {
    
    /** @var Plugin[] 每個測試都要載入的外掛 */
    protected array $required_plugins = [
        Plugin::WOOCOMMERCE,
        Plugin::POWER_WEBINAR
    ];
    /** @var \ReflectionClass 反射類別 */
    protected \ReflectionClass $reflection;
    
    /** 此類所有測試方法執行前執行一次 */
    public static function set_up_before_class(): void {}
    
    /** 此類所有測試方法執行後執行一次 */
    public static function tear_down_after_class(): void {}
    
    /** 設定 required_plugins 為啟用 */
    public function activate_plugins( $value, $option ): array {
        $value = is_array( $value ) ? $value : [];
        foreach ( $this->required_plugins as $plugin ) {
            $value[] = $plugin->value;
        }
        return $value;
    }
    
    /**
     * @return void
     */
    public function require_plugins(): void {
        foreach ( $this->required_plugins as $plugin ) {
            require_once PLUGIN_DIR . $plugin->value;
        }
    }
    
    /** 每個測試方法執行前執行一次 */
    public function set_up(): void {
        parent::set_up();
        // 載入必要外掛，做完主要的幾個生命週期
        \tests_add_filter( 'option_active_plugins', [ $this, 'activate_plugins' ], 1000, 2 );
        // 這邊 priority 必須 < -100 ，因為 WC 的 package 是 -100 時初始化
        \add_action( 'plugins_loaded', [ $this, 'require_plugins' ], -1000 );
        
        \do_action( 'plugins_loaded' );
        \do_action( 'after_setup_theme' );
        \do_action( 'init' );
        \do_action( 'wp_loaded' );
        \do_action( 'parse_request' );
        \do_action( 'rest_api_init' );
        \do_action( 'send_headers' );
        
        $this->reflection = new \ReflectionClass( static::class );
    }
    
    /** 每個測試方法執行後執行一次 */
    public function tear_down(): void {
        parent::tear_down();
    }
    
    /** 前置斷言：在每個測試開始前確認環境是否正確，例如確認某函式存在或某物件已初始化 */
    protected function assert_pre_conditions(): void {}
    
    /** 後置斷言：在每個測試結束前確認結果是否符合預期，例如確認資料未被污染或狀態未異常。 */
    protected function assert_post_conditions(): void {}
}