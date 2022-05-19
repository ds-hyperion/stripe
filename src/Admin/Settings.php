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
            'manage_options',
            __DIR__."/SettingsPageView.php"
        );

        //call register settings function
        add_action('admin_init', ['\Hyperion\Stripe\Admin\Settings','registerPluginSettings']);
    }

    public static function registerPluginSettings()
    {
        register_setting(self::SETTINGS_GROUP, \Hyperion\Stripe\Plugin::SECRET_STRIPE_ENDPOINT_OPTION);
        register_setting(self::SETTINGS_GROUP, \Hyperion\Stripe\Plugin::STRIPE_APIKEY);
    }
}