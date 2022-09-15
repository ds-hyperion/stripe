<?php

namespace Hyperion\Stripe\Model;

use JetBrains\PhpStorm\Pure;
use Stringable;

class ProductSearchModel implements Stringable
{
    private ?bool $active;
    private ?string $description;
    private ?array $metadata;
    private ?string $name;
    private ?bool $shippable;
    private ?string $url;

    public function __construct(
        ?bool $active = null,
        ?string $description = null,
        ?array $metadata = null,
        ?string $name = null,
        ?bool $shippable = null,
        ?string $url = null
    ) {
        $this->active = $active;
        $this->description = $description;
        $this->metadata = $metadata;
        $this->name = $name;
        $this->shippable = $shippable;
        $this->url = $url;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getShippable(): ?bool
    {
        return $this->shippable;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function __toString(): string
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
            foreach($this->getMetadata() as $metadata) {
                $metadataQueryPart[] = "metadata[\"".key($metadata)."\"] : \"".current($metadata)."\"";
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