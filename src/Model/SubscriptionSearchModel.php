<?php

namespace Hyperion\Stripe\Model;

use Stringable;

class SubscriptionSearchModel implements Stringable
{
    private ?int $created;
    private ?array $metadata;
    private ?string $status;

    public function __construct(
        ?int $created = null,
        ?array $metadata = null,
        ?string $status = null
    ) {
        $this->created = $created;
        $this->metadata = $metadata;
        $this->status = $status;
    }

    public function getCreated(): ?int
    {
        return $this->created;
    }

    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function __toString(): string
    {
        $metadataQueryPart = [];

        if($this->getCreated() !== null) {
            $metadataQueryPart[] = "created>".$this->getCreated();
        }

        if($this->getMetadata() !== null && count($this->getMetadata()) > 0) {
            foreach($this->getMetadata() as $key => $value) {
                $metadataQueryPart[] = "metadata[\"$key\"] : \"$value\"";
            }
        }

        if($this->getStatus()) {
            $metadataQueryPart[] = "status:\"".$this->getStatus()."\"";
        }

        return implode(" AND ", $metadataQueryPart);
    }
}