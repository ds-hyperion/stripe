<?php

namespace Hyperion\Stripe\Service;

class CustomerService extends StripeService
{
    private static array $customers = [];

    public static function getCustomerIdByEmail(string $email) : ?string
    {
        $emailMd5 = md5($email);
        if(isset(self::$customers[$emailMd5])) {
            return self::$customers[$emailMd5];
        }

        $client = self::getStripeClient();
        $customerCollection = $client->customers->all(['email' => strtolower($email)]);
        if (count($customerCollection) > 0) {
            self::$customers[$emailMd5] = current($customerCollection)->data->id;

            return self::$customers[$emailMd5];
        }

        return null;
    }


    public static function createCustomer(string $email,
                                          string $firstName,
                                          string $lastName,
                                          array $metadata = []) : string
    {
        $client = self::getStripeClient();
        $customer = $client->customers->create(
            [
                'email' => strtolower($email),
                'name' => trim(ucfirst(strtolower($firstName)))." ".trim(strtoupper($lastName)),
                'metadata' => $metadata
            ]
        );

        self::$customers[md5($email)] = $customer->id;

        return $customer->id;
    }

}