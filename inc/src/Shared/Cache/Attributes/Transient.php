<?php
declare(strict_types=1);
namespace J7\PowerWebinar\Shared\Cache\Attributes;

use Attribute;

/**
 * 用於標記方法，將其結果暫存為 transient 快取
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Transient {
	/**
	 * 建構子，設定快取過期時間（秒）
	 *
	 *   @param int $expire 過期時間（秒）
	 */
	public function __construct( public int $expire ) {}
}
