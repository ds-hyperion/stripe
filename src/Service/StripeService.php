<?php

namespace Hyperion\Stripe\Service;

use Exception;
use Hyperion\Stripe\Plugin;
use Stripe\PaymentIntent;
use Stripe\StripeClient;

class StripeService
{
    private static StripeClient $stripeClient;

    protected static function getStripeClient(): StripeClient
    {
        if (!isset(self::$stripeClient)) {
            $apiKey = get_option(Plugin::STRIPE_APIKEY);
            if ($apiKey === false) {
                throw new Exception("STRIPE APIKEY not set");
            }
            self::$stripeClient = new StripeClient($apiKey);
        }

        return self::$stripeClient;
    }

    public static function createPaymentIntent(
        float $amount,
        string $customerId,
        array $metadata = [],
        bool  $isForFutureUsage = false
    ) : PaymentIntent {
        $client = self::getStripeClient();

        $params = [
            'amount' => $amount * 100,
            'currency' => 'eur',
            'payment_method_types' => ['card'],
            'metadata' => $metadata,
            "customer" => $customerId
        ];

        if ($isForFutureUsage) {
            $params['setup_future_usage'] = 'off_session';
            //$params['automatic_payment_methods'] = [ 'enabled' => 'true'];
        }

        return $client->paymentIntents->create($params);
    }

    public static function addMetadataToPaymentIntent(PaymentIntent $paymentIntent, array $metadata)
    {
        $client = self::getStripeClient();
        $client->paymentIntents->update($paymentIntent->id, ['metadata' => $metadata]);
    }
}
