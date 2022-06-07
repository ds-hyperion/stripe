<?php

namespace Hyperion\Stripe\Model;

class ProductSearchModel
{
    private ?bool $active = null;
    private ?string $description = null;
    private ?array $metadata = null;
    private ?string $name = null;
    private ?bool $shippable = null;
    private ?string $url = null;

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): ProductSearchModel
    {
        $this->active = $active;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): ProductSearchModel
    {
        $this->description = $description;
        return $this;
    }

    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    public function addMetadata(array $metadata): ProductSearchModel
    {
        $this->metadata[] = $metadata;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): ProductSearchModel
    {
        $this->name = $name;
        return $this;
    }

    public function getShippable(): ?bool
    {
        return $this->shippable;
    }

    public function setShippable(?bool $shippable): ProductSearchModel
    {
        $this->shippable = $shippable;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): ProductSearchModel
    {
        $this->url = $url;
        return $this;
    }

    public function getMetadataQueryString(): string
    {
        $metadataQueryPart = [];

        if($this->getActive() !== null) {
            $booleanString = $this->getActive() === true ? 'true' : 'false';
            $metadataQueryPart[] = "active: \"$booleanString\"";
        }

        if($this->getDescription()) {
            $metadataQueryPart[] = "description~\"".$this->getDescription()."\"";
        }

        if($this->getMetadata() !== null && count($this->getMetadata()) > 0) {
            foreach($this->getMetadata() as $metadataKey => $metadataValue) {
                $metadataQueryPart[] = "metadata[\"$metadataKey\"] : \"$metadataValue\"";
            }
        }

        if($this->getName()) {
            $metadataQueryPart[] = "name~\"".$this->getName()."\"";
        }

        if($this->getShippable() !== null) {
            $booleanString = $this->getShippable() === true ? 'true' : 'false';
            $metadataQueryPart[] = "shippable: \"$booleanString\"";
        }

        if($this->getUrl()) {
            $metadataQueryPart[] = "url~\"" . $this->getUrl() . "\"";
        }

        return implode(" AND ", $metadataQueryPart);
    }
}