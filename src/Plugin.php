<?php

namespace Hyperion\Stripe;

class Plugin
{
    public const SECRET_STRIPE_ENDPOINT_OPTION = 'hyperion_secret_stripe_endpoint_option';
    public const STRIPE_APIKEY = 'hyperion_stripe_apikey';

    public static function install()
    {
        add_option(self::SECRET_STRIPE_ENDPOINT_OPTION);
        add_option(self::STRIPE_APIKEY);
    }

    public static function uninstall()
    {
        delete_option(self::SECRET_STRIPE_ENDPOINT_OPTION);
        delete_option(self::STRIPE_APIKEY);
    }
}