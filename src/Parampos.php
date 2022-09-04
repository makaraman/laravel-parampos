<?php

namespace Makaraman\Parampos;

use Makaraman\Parampos\Services\Request;
use Makaraman\Parampos\Traits\{
	Authentication,
	Configuration,
	Order
};

class Parampos
{
	use Authentication, Configuration, Order;

	/**
	 * Pass array param to set credentials
	 */
	public function __construct(?array $credentials = [])
	{
		$this->setApiCredentials($credentials);
	}

	private function getHashString()
	{
		$credentials = $this->getCredentialsWithoutGUID();

		$payload = [
			$credentials['CLIENT_CODE'],
			$this->getGUID(),
			$this->getInstallmentRate(),
			$this->getInstallmentAmount(),
			$this->getTotalAmount(),
			$this->getOrderId(),
			$this->getFailureUrl(),
			$this->getSuccessUrl()
		];

		return implode('', $payload);
	}

	/**
	 * Get Payment Data to make request
	 */
	public function getPaymentData(): array
	{
		$url = $this->getApiUrl();
		$creditCard = $this->getCreditCard();
		$hashString = $this->getHashString();

		$paymentData = [
			'G' => $this->getCredentialsWithoutGUID(),
			'GUID' => $this->getGUID(),
			'KK_Sahibi' => $creditCard['card_owner'],
			'KK_No' => $creditCard['card_number'],
			'KK_SK_Ay' => $creditCard['card_month'],
			'KK_SK_Yil' => $creditCard['card_year'],
			'KK_CVC' => $creditCard['card_cvc'],
			'Hata_URL' => $this->getFailureUrl(),
			'Basarili_URL' => $this->getSuccessUrl(),
			'Siparis_ID' => $this->getOrderId(),
			'Siparis_Aciklama' => $this->getOrderDescription(),
			'Taksit' => $this->getInstallmentRate(),
			'Islem_Tutar' => $this->getInstallmentAmount(),
			'Toplam_Tutar' => $this->getTotalAmount(),
			'Islem_Hash' => $this->getOrderHash($url, $hashString),
			'Islem_Guvenlik_Tip' => $this->getSecureType(),
			'Islem_ID' => '',
			'IPAdr' => $this->getIpAddress()
		];

		return $paymentData;
	}

	/**
	 * Return All Payment Data to the instance
	 */
	public function debugger()
	{
		return $this->getPaymentData();
	}

	/**
	 * Make request to send payment
	 */
	public function send(): array
	{
		$url = $this->getApiUrl();
		$paymentData = $this->getPaymentData();

		$response = Request::sendRequest($url, 'Pos_Odeme', $paymentData);
		$result = (array) data_get($response, 'Pos_OdemeResult');

		return $result;
	}
}
