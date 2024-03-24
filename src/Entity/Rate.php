<?php

namespace App\Entity;

use App\Repository\RateRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity(repositoryClass: RateRepository::class)]
class Rate implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 3)]
    private ?string $base = null;

    #[ORM\Column(length: 3)]
    private ?string $quote = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: 10)]
    private ?string $price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date = null;

    #[ORM\ManyToOne(inversedBy: 'rates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RatesSource $ratesSource = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBase(): ?string
    {
        return $this->base;
    }

    public function setBase(string $base): static
    {
        $this->base = $base;

        return $this;
    }

    public function getQuote(): ?string
    {
        return $this->quote;
    }

    public function setQuote(string $quote): static
    {
        $this->quote = $quote;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getRatesSource(): ?RatesSource
    {
        return $this->ratesSource;
    }

    public function setRatesSource(?RatesSource $ratesSource): static
    {
        $this->ratesSource = $ratesSource;

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'base' => $this->base,
            'price' => $this->price
        ];
    }
}
