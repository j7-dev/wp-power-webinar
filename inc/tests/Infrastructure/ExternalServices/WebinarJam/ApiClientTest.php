<?php

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam;

use J7\PowerWebinarTests\Shared\WC_UnitTestCase;
use  J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostWebinarListRequestDTO;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\DTOs\PostWebinarListResponseDTO;

final class ApiClientTest  extends WC_UnitTestCase {
    
    /**
     * @testdox 取得 webinar 列表成功
     */
    public function test_get_webinar_list_success(): void {
        $api_client = ApiClient::instance();
        $request_dto = PostWebinarListRequestDTO::instance();
        $result = $api_client->get_webinars($request_dto);
        $this->assertInstanceOf( PostWebinarListResponseDTO::class, $result);
        $this->assertEquals( 'success', $result->status);
    }
    
    
    /**
     * @testdox 取得 webinar 列表失敗 (錯誤的 api_key)
     * TODO
     */
    public function test_get_webinar_list_failed(): void {
        $api_config = ApiConfig::instance();
//
//        $api_client = ApiClient::instance();
//        $request_dto = PostWebinarListRequestDTO::instance();
//        $result = $api_client->get_webinars($request_dto);
//        $this->assertInstanceOf( PostWebinarListResponseDTO::class, $result);
//        $this->assertEquals( 'success', $result->status);
    }
}
