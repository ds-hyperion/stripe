<?php
/**
 * Plugin Name: Hyperion - Module Stripe
 * Plugin URI:
 * Description: Mise en place des webhook stripe
 * Version: 0.1
 * Requires PHP: 8.1
 * Author: Benoit DELBOE & Grégory COLLIN
 * Author URI:
 * Licence: GPLv2
 */

add_action('init', '\Hyperion\Stripe\Plugin::init');
add_action('admin_menu', '\Hyperion\Stripe\Plugin::addAdminPage');

register_activation_hook(__FILE__, '\Hyperion\Stripe\Plugin::install');
register_uninstall_hook(__FILE__, '\Hyperion\Stripe\Plugin::uninstall');