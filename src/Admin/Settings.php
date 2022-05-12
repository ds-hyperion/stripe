<?php

namespace Hyperion\Stripe\Admin;

class Settings
{
    public const SETTINGS_GROUP = 'stripeSettingsGroup';

    public static function createMenu()
    {
        //create new top-level menu
        add_menu_page('Configuration du plugin STRIPE',
            'Stripe',
            'administrator',
            __DIR__."/SettingsPageView.php"
        );

        //call register settings function
        add_action('admin_init', ['\Hyperion\Stripe\Admin\Settings','registerPluginSettings']);
    }

    public static function registerPluginSettings()
    {
        register_setting(self::SETTINGS_GROUP, 'hyperion_stripe_endpoint_secret');
        register_setting(self::SETTINGS_GROUP, 'hyperion_stripe_api_key');
    }
}