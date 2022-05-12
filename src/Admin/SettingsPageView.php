<div class="wrap">
    <h1>Stripe plugin settings</h1>

    <form method="post" action="options.php">
        <?php settings_fields( Hyperion\Stripe\Admin\Settings::SETTINGS_GROUP ); ?>
        <?php do_settings_sections( Hyperion\Stripe\Admin\Settings::SETTINGS_GROUP ); ?>
        <table class="form-table">
            <tr>
                <th scope="row">API Key</th>
                <td><input type="text" name="hyperion_stripe_api_key" value="<?php echo esc_attr( get_option('hyperion_stripe_api_key') ); ?>" /></td>
            </tr>
            <tr>
                <th scope="row">Endpoint Secret</th>
                <td><input type="text" name="hyperion_stripe_endpoint_secret" value="<?php echo esc_attr( get_option('hyperion_stripe_endpoint_secret') ); ?>" /></td>
            </tr>
        </table>

        <?php submit_button(); ?>

    </form>
</div>