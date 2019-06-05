<?php

namespace App\Factory;

use App\Entity\HashLink;

/**
 * Class HashLinkFactory.
 */
class HashLinkFactory
{
    /** @var HashLink */
    protected $hashLink;

    /**
     * HashLinkFactory constructor.
     * @param string $hashLink
     */
    public function __construct($hashLink)
    {
        $this->hashLink = new $hashLink();
    }

    /**
     * @see http://stackoverflow.com/questions/7003416/validating-a-url-in-php
     *
     * @param $url
     * @return HashLink
     * @throws \Exception
     */
    public function create($url)
    {
        // validate and sanitize
        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \Exception('invalid url');
        }
        $url = rtrim($url, '/');

        $this->hashLink->setLink($url);

        return $this->hashLink;
    }
}
