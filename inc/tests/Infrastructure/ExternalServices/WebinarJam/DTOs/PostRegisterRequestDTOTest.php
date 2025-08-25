<?php

namespace J7\PowerWebinarTest\Infrastructure\ExternalServices\WebinarJam\DTOs;

use J7\PowerWebinarTests\Shared\WC_UnitTestCase;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostRegisterRequestDTO;

/**
 * PostRegisterRequestDTOTest
 *
 * @ref https://support.webinarjam.com/support/solutions/articles/153000168626-register-a-person-to-a-specific-webinar-webinarjam-api-
 */
class PostRegisterRequestDTOTest extends WC_UnitTestCase {
    
    /**
     * @testdox 成功實例化
     */
    public function test_instance_success(): void {
       $args = [];
        $dto = PostRegisterRequestDTO::from($args);
        $this->assertInstanceOf( PostRegisterRequestDTO::class, $dto );
    }
}