<?php

namespace Hyperion\Stripe\Enum;

enum StripeEventEnum : string
{
    case PAYMENT_SUCCESS = 'payment_intent.succeeded';
    case SETUPINTENT_SUCCESS = 'setup_intent.succeeded';
    case SUBSCRIPTION_UPDATE = 'customer.subscription.updated';
}