<?php

namespace Hyperion\Stripe\Service;

use Exception;
use Hyperion\Stripe\Plugin;
use Stripe\StripeClient;

class StripeService
{
    private static StripeClient $stripeClient;

    public static function getStripeClient(): StripeClient
    {
        if (!isset(self::$stripeClient)) {
            $apiKey = get_option(Plugin::STRIPE_APIKEY);
            if ($apiKey === false) {
                throw new Exception("STRIPE APIKEY not set");
            }
            self::$stripeClient = new StripeClient([
                'api_key' => $apiKey,
                'stripe_version' => "2022-08-01"
            ]);
        }

        return self::$stripeClient;
    }
}
