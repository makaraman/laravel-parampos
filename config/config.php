<?php

return [
	/**
	 * Test Url
	 * İster config dosyasından çekin, ister parametre olarak gönderin
	 * Test modu aktif olduğunda; dev_url için bir parametre gönderilmediyse
	 * Test URL bu alandan çekilecektir
	 */
	'sandbox_url' => 'https://test-dmz.param.com.tr/turkpos.ws/service_turkpos_test.asmx?WSDL',

	/**
	 * Production Url
	 * İster config dosyasından çekin, ister parametre olarak gönderin
	 * Test modu pasif olduğunda; prod_url için bir parametre gönderilmediyse
	 * Prod URL bu alandan çekilecektir
	 */
	'live_url' => 'https://posws.param.com.tr/turkpos.ws/service_turkpos_prod.asmx?WSDL',

	'auth' => [
		'CLIENT_CODE' => '10738',
		'CLIENT_USERNAME' => 'Test',
		'CLIENT_PASSWORD' => 'Test',
		'GUID' => '0c13d406-873b-403b-9c09-a5766840d98c',
	]
];
