<?php

namespace J7\PowerWebinarTests\Shared;


/**
 * Plugin 列舉
 * 可以取得外掛路徑
 */
enum Plugin:string {
    case WOOCOMMERCE = 'woocommerce/woocommerce.php';
    case WOOCOMMERCE_SUBSCRIPTIONS = 'woocommerce-subscriptions/woocommerce-subscriptions.php';
    case POWERHOUSE = 'powerhouse/plugin.php';
    case POWER_PARTNER_SERVER = 'power-partner-server/plugin.php';
    case WPCD = 'wp-cloud-deploy/wpcd.php';
    case WPCD_WOOCOMMERCE = 'wpcd-woocommerce/wpcd-woocommerce.php';
}