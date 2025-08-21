<?php
/**
 * Debug Test
 * run `composer test:debug "inc\tests\DebugTest.php"`
 */

namespace J7\PowerWebinarTests;

use J7\PowerWebinarTests\Shared\WC_UnitTestCase;



/** Debug Test */
class DebugTest extends WC_UnitTestCase {
   
    /**
     * @testdox 測試 do_action 函式是否存在
     */
    public function test_do_action_exist(): void {
        $posts = \get_posts( [
            'post_type' => 'post',
            'numberposts' => 1,
        ] );
        $this->assertTrue( count( $posts ) === 0 );
    }
}
