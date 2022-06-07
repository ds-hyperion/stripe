<?php

namespace Hyperion\Stripe\Model;

class PriceSearchModel
{
    private ?bool $active = null;
    private ?string $currency = null;
    private ?string $lookupKey = null;
    private ?array $metadata = null;
    private ?string $product = null;
    private ?string $type = null;

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): PriceSearchModel
    {
        $this->active = $active;
        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): PriceSearchModel
    {
        $this->currency = $currency;
        return $this;
    }

    public function getLookupKey(): ?string
    {
        return $this->lookupKey;
    }

    public function setLookupKey(string $lookupKey): PriceSearchModel
    {
        $this->lookupKey = $lookupKey;
        return $this;
    }

    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    public function addMetadata(array $metadata): PriceSearchModel
    {
        $this->metadata[] = $metadata;
        return $this;
    }

    public function getProduct(): ?string
    {
        return $this->product;
    }

    public function setProduct(string $product): PriceSearchModel
    {
        $this->product = $product;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): PriceSearchModel
    {
        $this->type = $type;
        return $this;
    }

    public function getMetadataQueryString(): string
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
            foreach($this->getMetadata() as $metadataKey => $metadataValue) {
                $metadataQueryPart[] = "metadata[\"$metadataKey\"] : \"$metadataValue\"";
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