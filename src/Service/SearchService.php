<?php

namespace Hyperion\Stripe\Service;

use Hyperion\Stripe\Model\PriceSearchModel;
use Hyperion\Stripe\Model\ProductSearchModel;

class SearchService extends StripeService
{
    public static function searchProduct(ProductSearchModel $searchModel)
    {
        return self::getStripeClient()->products->search(['query' => $searchModel->getMetadataQueryString()]);
    }

    public static function searchPrice(PriceSearchModel $searchModel)
    {
        return self::getStripeClient()->prices->search(['query' => $searchModel->getMetadataQueryString()]);
    }
}