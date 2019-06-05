<?php

namespace App\Event;

use App\Entity\HashLink;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class HashLinkRedirectedEvent.
 */
class HashLinkRedirectedEvent extends Event
{
    /** @var HashLink */
    private $hashLink;

    /**
     * ShortUrlRedirectedEvent constructor.
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
