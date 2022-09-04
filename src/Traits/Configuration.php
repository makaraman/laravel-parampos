<?php

namespace Makaraman\Parampos\Traits;

trait Configuration
{
	// Test Mode
	private bool $testMode = true;

	// Success URL that return after successful payment
	private string $successUrl;

	// Failure URL that return after failed payment
	private string $failureUrl;

	// API Url based on the test mode
	private string $apiUrl;

	/**
	 * @param boolean
	 * Set test mode
	 * @return Parampos
	 */
	public function setTestMode(?bool $mode = true): self
	{
		$this->testMode = $mode;

		return $this;
	}

	/**
	 * @param boolean
	 * Get test mode
	 * @return bool
	 */
	private function isTest(): bool
	{
		return $this->testMode;
	}

	/**
	 * @param boolean
	 * Set Success Url
	 * @return Parampos
	 */
	public function setSuccessUrl(?string $url): self
	{
		$this->successUrl = $url;

		return $this;
	}

	/**
	 * @param boolean
	 * Get Success Url
	 * @return string
	 */
	private function getSuccessUrl(): string
	{
		return $this->successUrl;
	}

	/**
	 * @param string
	 * Set failure URL
	 * @return Parampos
	 */
	public function setFailureUrl(?string $url): self
	{
		$this->failureUrl = $url;

		return $this;
	}

	/**
	 * @return string
	 */
	private function getFailureUrl(): string
	{
		return $this->failureUrl;
	}

	/**
	 * @param string
	 * Set api URL
	 * @return Parampos
	 */
	public function setApiUrl(?string $url): self
	{
		$this->apiUrl = $url;

		return $this;
	}

	/**
	 * @return string
	 */
	private function getApiUrl(): string
	{
		if (!isset($this->apiUrl) || empty($this->apiUrl)) {
			$url = $this->isTest() ? config('parampos.sandbox_url') : config('parampos.prod_url');
		}

		return $this->apiUrl ?? $url;
	}
}
