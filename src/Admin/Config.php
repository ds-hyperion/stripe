<?php
    if(isset($_POST['stripe_endpoint_secret'])) {
        // Sauvegarde dans les options
        update_option(\Hyperion\Stripe\Plugin::SECRET_STRIPE_ENDPOINT_OPTION, $_POST['stripe_endpoint_secret']);
    }
?>

<div class="wrap">
    <form action="">
        <label for="stripe_endpoint_secret">Stripe endpoint secret : </label>
        <input type="text" id="stripe_endpoint_secret">
        <input type="submit" value="Sauvegarder">
    </form>
</div>
