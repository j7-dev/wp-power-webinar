<?php

namespace J7\PowerWebinarTest\Infrastructure\ExternalServices\WebinarJam;

use J7\PowerWebinarTests\Shared\WC_UnitTestCase;
use J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\ApiConfig;

class ApiConfigTest extends WC_UnitTestCase {
    
    /**
     * @testdox 成功實例化，且 api_url, api_key 為字串
     */
    public function test_instance_success(): void {
        $dto = ApiConfig::instance();
        $this->assertInstanceOf( ApiConfig::class, $dto );
        $this->assertIsString( $dto->api_url );
        $this->assertIsString( $dto->api_key );
    }
}
