<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HashLinkRepository")
 */
class HashLink
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hash;

    /**
     * @ORM\Column(type="string", length=10000)
     */
    private $link;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="hashLink")
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HashLinkStatistic", mappedBy="hashLinkId", cascade={"persist"})
     */
    private $hashLinkStatistics;

    public function __construct()
    {
        $this->hashLinkStatistics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->getHashLinkStatistics()->count();
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getHashLinkStatistics(): Collection
    {
        if (!$this->hashLinkStatistics) {
            $this->hashLinkStatistics = new ArrayCollection();
        }

        return $this->hashLinkStatistics;
    }

    public function addHashLinkStatistic(HashLinkStatistic $hashLinkStatistic): self
    {
        if (!$this->hashLinkStatistics->contains($hashLinkStatistic)) {
            $this->hashLinkStatistics[] = $hashLinkStatistic;
            $hashLinkStatistic->setHashLinkId($this);
        }

        return $this;
    }

    public function removeHashLinkStatistic(HashLinkStatistic $hashLinkStatistic): self
    {
        if ($this->hashLinkStatistics->contains($hashLinkStatistic)) {
            $this->hashLinkStatistics->removeElement($hashLinkStatistic);
            // set the owning side to null (unless already changed)
            if ($hashLinkStatistic->getHashLinkId() === $this) {
                $hashLinkStatistic->setHashLinkId(null);
            }
        }

        return $this;
    }
}
