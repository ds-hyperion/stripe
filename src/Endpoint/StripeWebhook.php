<?php

namespace Hyperion\Stripe\Endpoint;

use Hyperion\RestAPI\APIEnpointAbstract;
use Hyperion\RestAPI\APIManagement;
use Hyperion\RestAPI\Plugin;
use Hyperion\Stripe\Enum\StripeEventEnum;
use Hyperion\Stripe\Enum\WordpressEventEnum;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;
use WP_REST_Request;
use WP_REST_Response;

class StripeWebhook extends APIEnpointAbstract
{
    public static function callback(WP_REST_Request $request): WP_REST_Response
    {
        $endpoint_secret = getenv('STRIPE_ENDPOINT_SECRET');

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

        try {
            $eventPayload = json_decode( $event->data->object, true, 512, JSON_THROW_ON_ERROR );

            switch ($event->type) {
                case StripeEventEnum::PAYMENT_SUCCESS->value :
                    do_action(StripeEventEnum::PAYMENT_SUCCESS->value,$eventPayload);
                    break;
                case StripeEventEnum::SETUPINTENT_SUCCESS->value :
                    do_action(StripeEventEnum::SETUPINTENT_SUCCESS->value, $eventPayload);
                    break;
            }

            return APIManagement::APIOk();

        } catch (\Exception $exception) {
            return APIManagement::APIError("Erreur dans le décodage de l'objet json", 400);
        }
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