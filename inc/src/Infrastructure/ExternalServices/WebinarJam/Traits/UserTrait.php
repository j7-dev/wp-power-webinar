<?php

namespace J7\PowerWebinar\Infrastructure\ExternalServices\WebinarJam\Traits;

trait UserTrait {
	/** @var string  *名字 */
	public string $first_name;

	/** @var string  姓 */
	public string $last_name;

	/** @var string  *email */
	public string $email;

	/** @var string  ip_address */
	public string $ip_address;

	/** @var string  手機國碼，+開頭 */
	public string $phone_country_code;

	/** @var string  手機號碼 */
	public string $phone;
}
