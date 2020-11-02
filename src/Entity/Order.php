<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Luggage::class, mappedBy="Cart")
     */
    private $luggage;

    public function __construct()
    {
        $this->luggage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Luggage[]
     */
    public function getLuggage(): Collection
    {
        return $this->luggage;
    }

    public function addLuggage(Luggage $luggage): self
    {
        if (!$this->luggage->contains($luggage)) {
            $this->luggage[] = $luggage;
            $luggage->setCart($this);
        }

        return $this;
    }

    public function removeLuggage(Luggage $luggage): self
    {
        if ($this->luggage->removeElement($luggage)) {
            // set the owning side to null (unless already changed)
            if ($luggage->getCart() === $this) {
                $luggage->setCart(null);
            }
        }

        return $this;
    }
}
