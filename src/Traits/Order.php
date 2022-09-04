<?php

namespace Makaraman\Parampos\Traits;

use Exception;
use Makaraman\Parampos\Services\Request;

trait Order
{
	private string $creditCardOwner;
	private string $creditCardNumber;
	private string $creditCardMonth;
	private string $creditCardYear;
	private string $creditCardCvc;
	private string $orderId;
	private string $orderDescription;
	private int $installmentRate = 1;
	private string $installmentAmount;
	private string $totalAmount;
	private string $hash;
	private string $secureType = '3D'; // NS - NONSECURE | 3D - 3DSECURE
	private string $proccessId; // TODO
	private string $ipAddress;
	private array $extra; // TODO

	/**
	 * @param array
	 * Set Credit Card Info
	 * @return self
	 */
	public function setCreditCard(?array $payload): self
	{
		try {
			$this->creditCardOwner = $payload['card_owner'];
			$this->creditCardNumber = $payload['card_number'];
			$this->creditCardMonth = $payload['card_month'];
			$this->creditCardYear = $payload['card_year'];
			$this->creditCardCvc = $payload['card_cvc'];
		} catch (\Exception) {
			throw new Exception("Missing/Incorrect Credit Card Informations");
		}

		return $this;
	}

	/**
	 * Credit Card Info
	 * @return array
	 */
	private function getCreditCard(): array
	{
		return [
			'card_owner' => $this->creditCardOwner,
			'card_number' => $this->creditCardNumber,
			'card_month' => $this->creditCardMonth,
			'card_year' => $this->creditCardYear,
			'card_cvc' => $this->creditCardCvc,
		];
	}

	/**
	 * @param string
	 * Order Id
	 * @return self
	 */
	public function setOrderId(?string $orderId): self
	{
		$this->orderId = $orderId;

		return $this;
	}

	/**
	 * @return string $this->orderId
	 */
	private function getOrderId(): string
	{
		return $this->orderId;
	}

	/**
	 * @param string
	 * Order Description
	 * @return self
	 */
	public function setOrderDescription(?string $orderDescription): self
	{
		$this->orderDescription = $orderDescription;

		return $this;
	}

	/**
	 * @return string $this->orderDescription
	 */
	private function getOrderDescription(): string
	{
		return $this->orderDescription;
	}

	/**
	 * @param int
	 * Installment Rate
	 * @return self
	 */
	public function setInstallmentRate(?int $rate = 1): self
	{
		$this->installmentRate = (int) $rate !== 0 ? $rate : 1;

		return $this;
	}

	/**
	 * @return int $this->installmentRate
	 */
	private function getInstallmentRate(): int
	{
		return $this->installmentRate;
	}

	/**
	 * @param string
	 * Installment Amount
	 * @return self
	 */
	public function setInstallmentAmount(?string $amount): self
	{
		$this->installmentAmount = $amount;

		return $this;
	}

	/**
	 * @return string $this->installmentAmount
	 */
	private function getInstallmentAmount(): string
	{
		return number_format($this->installmentAmount, 2, ',', '');
	}

	/**
	 * @param string
	 * Total Order Amount
	 * @return self
	 */
	public function setTotalAmount(?string $amount): self
	{
		$this->totalAmount = $amount;

		return $this;
	}

	/**
	 * @return string $this->totalAmount
	 */
	private function getTotalAmount(): string
	{
		return number_format($this->totalAmount, 2, ',', '');
	}

	/**
	 * @param string URL -> Test | Prod
	 * @param string Hash String
	 */
	private function getOrderHash($url, $hashString)
	{
		$response = Request::sendRequest($url, 'SHA2B64', ['Data' => $hashString]);

		return data_get($response, 'SHA2B64Result');
	}

	/**
	 * @param string IP Address
	 * @return self
	 */
	public function setIpAddress($ip): self
	{
		$this->ipAddress = $ip;

		return $this;
	}

	/**
	 * @return string $this->ipAddress
	 */
	private function getIpAddress(): ?string
	{
		return $this->ipAddress ?? null;
	}

	/**
	 * @return string
	 */
	public function setSecureType(?string $type = '3D'): self
	{
		$this->secureType = $type;

		return $this;
	}

	/**
	 * @return string
	 */
	private function getSecureType(): string
	{
		return $this->secureType;
	}
}
