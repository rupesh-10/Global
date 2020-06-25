<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Omnipay\Omnipay;

class Esewa extends Model
{
    public function gateway()
    {
        $gateway = Omnipay::create('Esewa_Secure');

        $gateway->setMerchantCode(config('services.esewa.merchant'));
        $gateway->setTestMode(config('services.esewa.sandbox'));

        return $gateway;
    }

    /**
     * @param array $parameters
     * @return $response
     */
    public function purchase(array $parameters)
    {
        try {
            $response = $this->gateway()
                ->purchase($parameters)
                ->send();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $response;
    }

    /**
     * @param array $parameters
     * @return $response
     */
    public function verifyPayment(array $parameters)
    {
        $response = $this->gateway()
            ->verifyPayment($parameters)
            ->send();

        return $response;
    }

    /**
     * @param $amount
     */
    public function formatAmount($amount)
    {
        return number_format($amount, 2, '.', '');
    }

    /**
     * @param $sale
     */
    public function getFailedUrl($sale)
    {
        return route('checkout.payment.esewa.failed', $sale->id);
    }

    /**
     * @param $sale
     */
    public function getReturnUrl($sale)
    {
        return route('checkout.payment.esewa.completed', $sale->id);
    }
}
