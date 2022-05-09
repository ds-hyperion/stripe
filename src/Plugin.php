<?php

namespace Hyperion\Stripe;

class Plugin
{
    public const SECRET_STRIPE_ENDPOINT_OPTION = 'hyperion_secret_stripe_endpoint_option';

    public static function init()
    {
        add_menu_page(
            'Configuration du plugin stripe',
            'Stripe',
            'manage_options',
            'Admin/Config.php'
        );
    }

    public static function install()
    {
        add_option(self::SECRET_STRIPE_ENDPOINT_OPTION);
    }

    public static function uninstall()
    {
        // Remove secret from wordpress option
        delete_option(self::SECRET_STRIPE_ENDPOINT_OPTION);
    }

    private static function checkEnv()
    {
        $endpoint_secret = getenv('STRIPE_ENDPOINT_SECRET');
        if(false === $endpoint_secret) {
            throw new \Exception("No endpoint secret for stripe set");
        }
    }
}