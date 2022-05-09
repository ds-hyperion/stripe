<?php

namespace Hyperion\Stripe\Service;

use Exception;
use Hyperion\Stripe\Plugin;
use Stripe\StripeClient;

abstract class StripeService
{
    private static StripeClient $stripeClient;

    protected static function getStripeClient(): StripeClient
    {
        if(!isset(self::$stripeClient)) {
            $apiKey = get_option(Plugin::STRIPE_APIKEY);
            if($apiKey === false) {
                throw new Exception("STRIPE APIKEY not set");
            }
            self::$stripeClient = new StripeClient($apiKey);
        }

        return self::$stripeClient;
    }


}