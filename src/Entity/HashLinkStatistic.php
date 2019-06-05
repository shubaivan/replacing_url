<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HashLinkStatisticRepository")
 */
class HashLinkStatistic
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userAgent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $api;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HashLink", inversedBy="hashLinkStatistics")
     */
    private $hashLinkId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function setUserAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    public function getApi(): ?string
    {
        return $this->api;
    }

    public function setApi(string $api): self
    {
        $this->api = $api;

        return $this;
    }

    public function getHashLinkId(): ?HashLink
    {
        return $this->hashLinkId;
    }

    public function setHashLinkId(?HashLink $hashLinkId): self
    {
        $this->hashLinkId = $hashLinkId;

        return $this;
    }
}
