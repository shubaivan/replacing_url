<?php

namespace App\Event;

use App\Entity\HashLink;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class HashLinkCreatedEvent.
 */
class HashLinkCreatedEvent extends Event
{
    /** @var HashLink */
    private $hashLink;

    /**
     * HashLinkCreatedEvent constructor.
     * @param HashLink $hashLink
     */
    public function __construct(HashLink $hashLink)
    {
        $this->hashLink = $hashLink;
    }

    /**
     * @return HashLink
     */
    public function getHashLink(): HashLink
    {
        return $this->hashLink;
    }
}
