<?php

namespace Hyperion\Stripe\Model;

use JetBrains\PhpStorm\Pure;

class CustomerSearchModel implements \Stringable
{
    private ?int $created;
    private ?string $email;
    private ?array $metadata;
    private ?string $name;
    private ?string $phone;

    public function __construct(
        ?\DateTime $created = null,
        ?string $email = null,
        ?array $metadata = null,
        ?string $name = null,
        ?string $phone = null
    )
    {
        $this->created = $created?->getTimestamp();
        $this->email = $email;
        $this->metadata = $metadata;
        $this->name = $name;
        $this->phone = $phone;
    }

    public function getCreated(): ?int
    {
        return $this->created;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    #[Pure] public function __toString()
    {
        $metadataQueryPart = [];

        if($this->getCreated()) {
            $metadataQueryPart[] = "created>".$this->getCreated();
        }

        if($this->getEmail()) {
            $metadataQueryPart[] = "email~\"".$this->getEmail()."\"";
        }

        if($this->getMetadata() !== null && count($this->getMetadata()) > 0) {
            foreach($this->getMetadata() as $metadata) {
                $metadataQueryPart[] = "metadata[\"".key($metadata)."\"] : \"".current($metadata)."\"";
            }
        }

        if($this->getName()) {
            $metadataQueryPart[] = "name~\"".$this->getName()."\"";
        }

        if($this->getPhone()) {
            $metadataQueryPart[] = "phone:\"".$this->getPhone()."\"";
        }

        return implode(" AND ", $metadataQueryPart);
    }
}