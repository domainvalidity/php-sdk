<?php

namespace Domainvalidity\Sdk;

class Host
{
    public function __construct(
        public bool $valid,
        public string $original,
        public ?string $host = null,
        public ?string $domain = null,
        public ?string $tld = null,
    ) {
    }

    public function isValid(): bool
    {
       return $this->valid;
    }

    public function original(): string
    {
       return $this->original;
    }

    public function host(): ?string
    {
        return $this->host;
    }

    public function tld(): ?string
    {
        return $this->tld;
    }

    public function domain(): ?string
    {
        return $this->domain;
    }

    public function toArray(): array
    {
        return [
            'valid' => $this->isValid(),
            'original' => $this->original(),
            'host' => $this->host(),
            'domain' => $this->domain(),
            'tld' => $this->tld(),
        ];
    }
}
