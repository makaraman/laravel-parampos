<?php

namespace Makaraman\Parampos\Traits;

use Exception;
use Illuminate\Support\Arr;

trait Authentication
{
	private array $apiCredentials;

	/**
	 * @param ?array $credentials
	 * @return \Makaraman\Parampos\Parampos
	 */
	public function setApiCredentials(?array $credentials = []): self
	{
		$apiCredentials = !empty($credentials) ? $credentials : config('parampos.auth');

		$this->apiCredentials = $apiCredentials;

		return $this;
	}

	/**
	 * @return string
	 * Get Credentials without GUID
	 */
	private function getCredentialsWithoutGUID(): ?array
	{
		try {
			return Arr::except($this->apiCredentials, 'GUID');
		} catch (Exception $e) {
			throw new Exception('Missing Credentials' . ' ' . $e->getMessage());
		}
	}

	/**
	 * @return string
	 * Get GUID from api credentials
	 */
	private function getGUID(): ?string
	{
		try {
			return $this->apiCredentials['GUID'];
		} catch (Exception $e) {
			throw new Exception('Missing Credentials GUID' . ' ' . $e->getMessage());
		}
	}
}
