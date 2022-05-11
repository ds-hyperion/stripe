<?php

namespace Hyperion\Stripe\Service;

use Stripe\Invoice;
use Stripe\PaymentIntent;
use Stripe\Price;

class BillingService extends StripeService
{
    public static function createLineItem(string $customerId,
                                           string $priceId,
                                           int $quantity) : void
    {
        $client = self::getStripeClient();

        $client->invoiceItems->create(
            [
                'customer' => $customerId,
                'price' => $priceId,
                'quantity' => $quantity
            ]
        );
    }

    public static function createCustomPrice(float $amount,
                                             string $stripeProductId,
                                             string $currency = 'eur') : Price
    {
        return self::getStripeClient()->prices->create(
            [
                'unit_amount' => $amount * 100,
                'currency' => $currency,
                'product' => $stripeProductId
            ]
        );
    }

    public static function createBill(string $customerId) : Invoice
    {
        $client = self::getStripeClient();

        $invoice = $client->invoices->create(
            [
                'customer' => $customerId
            ]
        );

        return $invoice;
    }

    public static function finalizeAndGetPaymentIntent(Invoice $invoice) : PaymentIntent
    {
        $client = self::getStripeClient();
        $invoice = $client->invoices->finalizeInvoice($invoice->id);

        return $client->paymentIntents->retrieve($invoice->payment_intent);
    }
}