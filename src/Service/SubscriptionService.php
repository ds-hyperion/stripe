<?php

namespace Hyperion\Stripe\Service;

use D4rk0snet\Donation\Enums\DonationRecurrencyEnum;
use Stripe\Subscription;

class SubscriptionService extends StripeService
{
    public static function createSubscription(
        string $customerId,
        float $amount
    ) : Subscription {
        $price = self::getStripeClient()->prices->create([
            'unit_amount' => $amount,
            'currency' => 'eur',
            'recurring' => ['interval' => 'month'],
            'product' => DonationRecurrencyEnum::MONTHLY->getStripeProductId()
        ]);

        return self::getStripeClient()->subscriptions->create(
            [
                'customer' => $customerId,
                'items' => [[
                    'price' => $price->id
                ]]
            ]
        );
    }
}
