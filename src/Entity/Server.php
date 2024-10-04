<?php

namespace App\Entity;

class Server
{
    private $model;
    private $ram;
    private $hdd;
    private $location;
    private $price;

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;
        return $this;
    }

    public function getRam(): ?string
    {
        return $this->ram;
    }

    public function setRam(string $ram): self
    {
        $this->ram = $ram;
        return $this;
    }

    public function getHdd(): ?string
    {
        return $this->hdd;
    }

    public function setHdd(string $hdd): self
    {
        $this->hdd = $hdd;
        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }
}
