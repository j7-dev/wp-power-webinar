<?php

namespace J7\PowerWebinarTest\Infrastructure\ExternalServices\WebinarJam\DTOs;

use J7\PowerWebinarTests\Shared\WC_UnitTestCase;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostWebinarListRequestDTO;

/**
 * PostWebinarListRequestDTO
 *
 * @ref https://support.webinarjam.com/support/solutions/articles/153000168632-retrieve-a-full-list-of-all-webinars-published-in-your-account-webinarjam-api-
 */
class PostWebinarListRequestDTOTest extends WC_UnitTestCase {
    
    /**
     * @testdox 成功實例化
     */
    public function test_instance_success(): void {
        $dto = PostWebinarListRequestDTO::instance();
        $this->assertInstanceOf( PostWebinarListRequestDTO::class, $dto );
        
        $dto_array = $dto->to_array();
        $this->assertArrayHasKey( 'api_key', $dto_array );
        $this->assertIsString( $dto_array['api_key'] );
    }
}