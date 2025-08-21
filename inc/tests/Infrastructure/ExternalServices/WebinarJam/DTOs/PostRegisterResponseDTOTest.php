<?php

namespace J7\PowerWebinarTest\Infrastructure\ExternalServices\WebinarJam\DTOs;

use J7\PowerWebinarTests\Shared\WC_UnitTestCase;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostRegisterResponseDTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\RegisteredUserDTO;

/**
 * PostRegisterResponseDTOTest
 *
 * @ref https://support.webinarjam.com/support/solutions/articles/153000168626-register-a-person-to-a-specific-webinar-webinarjam-api-
 */
class PostRegisterResponseDTOTest extends WC_UnitTestCase {
    
    /**
     * @testdox 成功從 api response 實例化
     */
    public function test_instance_success(): void {
        $webinars_response = [
            "status" => "success",
            "user"   => [
                "webinar_id"         => 5,
                "webinar_hash"       => "pqrs7890",
                "user_id"            => 1234567,
                "first_name"         => "FirstName",
                "last_name"          => "LastName",
                "phone_country_code" => "+1",
                "phone"              => "1234567890",
                "email"              => "test@email.com",
                "password"           => null,
                "schedule"           => 34,
                "date"               => "2024-01-05 13:00",
                "timezone"           => "America/Los_Angeles",
                "live_room_url"      => "https://event.webinarjam.com/go/live/5/ab1cd2ef3",
                "replay_room_url"    => "https://event.webinarjam.com/go/replay/5/ab1cd2ef3",
                "thank_you_url"      => "https://event.webinarjam.com/registration/thank-you/5/ab1cd2ef3gh4"
            ]
        ];
        $dto = PostRegisterResponseDTO::from( $webinars_response );
        $this->assertInstanceOf( PostRegisterResponseDTO::class, $dto );
        $this->assertIsString( $dto->status );
        $this->assertInstanceOf( RegisteredUserDTO::class, $dto->user );
    }
    
}