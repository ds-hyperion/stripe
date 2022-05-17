<?php

namespace Hyperion\Stripe\Service;

use D4rk0snet\Donation\Enums\DonationRecurrencyEnum;
use Stripe\Customer;

class SubscriptionService extends StripeService
{
    public static function createSubscription(
        string $customerEmail,
        string $firstname,
        string $lastname,
        string $paymentMethodId,
        float $amount
    ) {
        /** @var Customer $customer */
        $customer = CustomerService::getCustomerIdByEmail($customerEmail);
        if ($customer === null) {
            $customer = CustomerService::createCustomer(
                email: $customerEmail,
                firstName: $firstname,
                lastName: $lastname,
                metadata: ['type' => 'individual']
            );
        }

        self::getStripeClient()->paymentMethods->attach($paymentMethodId, [
            'customer' => $customer->id
        ]);

        self::getStripeClient()->customers->update($customer->id, [
            'invoice_settings' => [
                'default_payment_method' => $paymentMethodId
            ]
        ]);

        $price = self::getStripeClient()->prices->create([
            'unit_amount' => $amount * 100,
            'currency' => 'eur',
            'recurring' => ['interval' => 'month'],
            'product' => DonationRecurrencyEnum::MONTHLY->getStripeProductId()
        ]);

        $subscription = self::getStripeClient()->subscriptions->create(
            [
                'customer' => $customer->id,
                'items' => [
                    'price' => $price->id
                ]
            ]
        );
    }
}
