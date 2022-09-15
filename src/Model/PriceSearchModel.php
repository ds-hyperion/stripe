<?php

namespace Hyperion\Stripe\Model;

use JetBrains\PhpStorm\Pure;
use Stringable;

class PriceSearchModel implements Stringable
{
    private ?bool $active;
    private ?string $currency;
    private ?string $lookupKey;
    private ?array $metadata;
    private ?string $product;
    private ?string $type;

    public function __construct(
        ?bool $active = null,
        ?string $currency = null,
        ?string $lookupKey = null,
        ?array $metadata = null,
        ?string $product = null,
        ?string $type = null
    )
    {
        $this->active = $active;
        $this->currency = $currency;
        $this->lookupKey = $lookupKey;
        $this->metadata = $metadata;
        $this->product = $product;
        $this->type = $type;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function getLookupKey(): ?string
    {
        return $this->lookupKey;
    }

    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    public function getProduct(): ?string
    {
        return $this->product;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    #[Pure] public function __toString(): string
    {
        $metadataQueryPart = [];

        if($this->getActive() !== null) {
            $booleanString = $this->getActive() === true ? 'true' : 'false';
            $metadataQueryPart[] = "active: \"$booleanString\"";
        }

        if($this->getCurrency()) {
            $metadataQueryPart[] = "currency: \"".$this->getCurrency()."\"";
        }

        if($this->getMetadata() !== null && count($this->getMetadata()) > 0) {
            foreach($this->getMetadata() as $metadata) {
                $metadataQueryPart[] = "metadata[\"".key($metadata)."\"] : \"".current($metadata)."\"";
            }
        }

        if($this->getLookupKey()) {
            $metadataQueryPart[] = "lookup_key : \"".$this->getLookupKey()."\"";
        }

        if($this->getProduct() !== null) {
            $metadataQueryPart[] = "product: \"".$this->getProduct()."\"";
        }

        if($this->getType()) {
            $metadataQueryPart[] = "type: \"" . $this->getType() . "\"";
        }

        return implode(" AND ", $metadataQueryPart);
    }

}