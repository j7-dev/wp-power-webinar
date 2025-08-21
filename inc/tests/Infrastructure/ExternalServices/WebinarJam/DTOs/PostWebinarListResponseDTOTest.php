<?php

namespace J7\PowerWebinarTest\Infrastructure\ExternalServices\WebinarJam\DTOs;

use J7\PowerWebinarTests\Shared\WC_UnitTestCase;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostWebinarListResponseDTO;

/**
 * PostWebinarListResponseDTO
 *
 * @ref https://support.webinarjam.com/support/solutions/articles/153000168632-retrieve-a-full-list-of-all-webinars-published-in-your-account-webinarjam-api-
 */
class PostWebinarListResponseDTOTest extends WC_UnitTestCase {
    
    /**
     * @testdox 成功從 api response 實例化
     */
    public function test_instance_success(): void {
        $webinars_response = [
            "status" => "success",
            "webinars" => [
                [
                    "webinar_id" => 4,
                    "webinar_hash" => "lmno3456",
                    "name" => "Demo4",
                    "title" => "Demo4",
                    "description" => "Right now",
                    "type" => "Right Now",
                    "schedules" => [
                        "Right now"
                    ],
                    "timezone" => "America/New_York"
                ],
                [
                    "webinar_id" => 3,
                    "webinar_hash" => "hijk9012",
                    "name" => "Demo3",
                    "title" => "Demo3",
                    "description" => "My always on webinar",
                    "type" => "Always on",
                    "schedules" => [
                        "Always on"
                    ],
                    "timezone" => "America/New_York"
                ],
                [
                    "webinar_id" => 2,
                    "webinar_hash" => "defg5678",
                    "name" => "Demo2",
                    "title" => "Demo2",
                    "description" => "Description of webinar",
                    "type" => "Single presentation",
                    "schedules" => [
                        "Friday, 5 Jan 2024, 01:00 PM"
                    ],
                    "timezone" => "America/Los_Angeles"
                ],
                [
                    "webinar_id" => 1,
                    "webinar_hash" => "abcd1234",
                    "name" => "Demo1",
                    "title" => "Demo1",
                    "description" => "A series of events",
                    "type" => "Series of presentations",
                    "schedules" => [
                        "Every day, 01:00 PM",
                        "Every Tuesday, 02:00 PM"
                    ],
                    "timezone" => "America/Los_Angeles"
                ]
            ]
        ];
        $dto = PostWebinarListResponseDTO::from( $webinars_response );
        $this->assertInstanceOf( PostWebinarListResponseDTO::class, $dto);
        $this->assertIsString($dto->status);
        $this->assertIsArray($dto->webinars);
    }
}