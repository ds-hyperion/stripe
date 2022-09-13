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
        if (count($customerCollection->data) > 0) {
            return current($customerCollection->data);
        }

        return null;
    }


    public static function getOrCreateIndividualCustomer(
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
                'metadata' => array_merge(['type' => 'individual'], $metadata)
            ]
        );

        self::$customers[md5($email)] = $customer;

        return $customer;
    }


    public static function getOrCreateCompanyCustomer(
        string $email,
        string $companyName,
        string $mainContactName,
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
                'name' => ucfirst(trim($mainContactName)) ." - $companyName",
                'metadata' => array_merge(['type' => 'company'], $metadata)
            ]
        );

        self::$customers[md5($email)] = $customer;

        return $customer;
    }
}
