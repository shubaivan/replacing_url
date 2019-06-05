<?php

namespace App\Exception;

use Exception as Exception;

class InvalidUrlException extends Exception
{
    /**
     * InvalidUrlException constructor.
     *
     * @param string $message
     */
    public function __construct($message = 'Url is not valid')
    {
        parent::__construct($message);
    }
}
