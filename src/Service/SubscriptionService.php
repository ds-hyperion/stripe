<?php

namespace Hyperion\Stripe\Service;

use D4rk0snet\Donation\Enums\DonationRecurrencyEnum;
use Stripe\Subscription;

class SubscriptionService extends StripeService
{
    public static function createSubscription(
        string $customerId,
        float $amount,
        string $defaultPaymentMethod,
        string $productId
    ) : Subscription {

        $price = self::getStripeClient()->prices->create([
            'unit_amount' => $amount,
            'currency' => 'eur',
            'recurring' => ['interval' => 'month'],
            'product' => $productId
        ]);

        return self::getStripeClient()->subscriptions->create(
            [
                'customer' => $customerId,
                'items' => [[
                    'price' => $price->id
                ]],
                'default_payment_method' => $defaultPaymentMethod
            ]
        );
    }
}
