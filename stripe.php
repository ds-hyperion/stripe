<?php
/**
 * Plugin Name: Stripe webhook
 * Plugin URI:
 * Description: Mise en place des webhook stripe
 * Version: 0.1
 * Requires PHP: 8.1
 * Author: Benoit DELBOE & Grégory COLLIN
 * Author URI:
 * Licence: GPLv2
 */

add_action('init', '\Hyperion\Stripe\Plugin::init');
register_activation_hook(__FILE__, '\Hyperion\Stripe\Plugin::install');
register_uninstall_hook(__FILE__, '\Hyperion\Stripe\Plugin::uninstall');