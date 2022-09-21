<?php

namespace Hyperion\Stripe\Endpoint;

use Hyperion\RestAPI\APIEnpointAbstract;
use Hyperion\RestAPI\APIManagement;
use Hyperion\RestAPI\Plugin;
use Hyperion\Stripe\Enum\StripeEventEnum;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;
use WP_REST_Request;
use WP_REST_Response;

class StripeWebhook extends APIEnpointAbstract
{
    public static function callback(WP_REST_Request $request): WP_REST_Response
    {
        $endpoint_secret = get_option(\Hyperion\Stripe\Plugin::SECRET_STRIPE_ENDPOINT_OPTION);

        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $payload = $request->get_body();

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException|SignatureVerificationException $e) {
            return APIManagement::APIError('Erreur dans la vérification de la signature stripe.', 400);
        }

        do_action($event->type, $event->data->object);

        return APIManagement::APIOk();
    }

    public static function getEndpoint(): string
    {
        return 'stripe_webhook';
    }

    public static function getMethods(): array
    {
        return ['POST'];
    }

    public static function getAPINamespace(): string
    {
        return get_option(Plugin::API_NAMESPACE_OPTION);
    }

    public static function getPermissions(): string
    {
        return  '__return_true';
    }
}