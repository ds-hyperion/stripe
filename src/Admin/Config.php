<?php
    if(isset($_POST['stripe_endpoint_secret']) && isset($_POST['stripe_api_key'])) {
        // Sauvegarde dans les options
        update_option(\Hyperion\Stripe\Plugin::SECRET_STRIPE_ENDPOINT_OPTION, $_POST['stripe_endpoint_secret']);
        update_option(\Hyperion\Stripe\Plugin::STRIPE_APIKEY, $_POST['stripe_api_key']);
    }
?>

<div class="wrap">
    <form method="post">
        <label for="stripe_endpoint_secret">Stripe endpoint secret : </label>
        <input type="text" id="stripe_endpoint_secret">

        <label for="stripe_endpoint_secret">Stripe APIKEY : </label>
        <input type="text" id="stripe_api_key">

        <input type="submit" value="Sauvegarder">
    </form>
</div>
