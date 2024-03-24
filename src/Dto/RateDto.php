<?php

namespace App\Dto;

class RateDto
{
    private string $CharCode;

    private string $VunitRate;

    public function getCharCode(): string
    {
        return $this->CharCode;
    }

    public function setCharCode(string $CharCode): self
    {
        $this->CharCode = $CharCode;

        return $this;
    }

    public function getVunitRate(): string
    {
        return $this->VunitRate;
    }

    public function setVunitRate(string $VunitRate): self
    {
        $this->VunitRate = $VunitRate;

        return $this;
    }
}
