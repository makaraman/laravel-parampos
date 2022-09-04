<?php

namespace Makaraman\Parampos\Services;

use SoapClient;

class Request
{
	public static function sendRequest($url, $method, array $params = [])
	{
		$client = new SoapClient($url);
		$response = $client->__soapCall($method, [$params]);

		return $response;
	}
}
