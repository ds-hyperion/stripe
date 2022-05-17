<?php

namespace Hyperion\Stripe\Service;

use Stripe\Customer;

class CustomerService extends StripeService
{
    private static array $customers = [];

    private static function getCustomerIdByEmail(string $email) : ?Customer
    {
        $emailMd5 = md5($email);
        if (isset(self::$customers[$emailMd5])) {
            return self::$customers[$emailMd5];
        }

        $client = self::getStripeClient();
        $customerCollection = $client->customers->all(['email' => strtolower($email)]);
        if (count($customerCollection) > 0) {
            self::$customers[$emailMd5] = current($customerCollection)->data;

            return self::$customers[$emailMd5];
        }

        return null;
    }


    public static function getOrCreateCustomer(
        string $email,
        string $firstName,
        string $lastName,
        array $metadata = []
    ) : Customer {
        $client = self::getStripeClient();

        $customer = self::getCustomerIdByEmail($email);
        if ($customer !== null) {
            return $customer;
        }

        $customer = $client->customers->create(
            [
                'email' => strtolower($email),
                'name' => trim(ucfirst(strtolower($firstName)))." ".trim(strtoupper($lastName)),
                'metadata' => $metadata
            ]
        );

        self::$customers[md5($email)] = $customer;

        return $customer;
    }
}
