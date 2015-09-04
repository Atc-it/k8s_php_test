<?php

namespace Greetings;

class Hello
{
    private $greet;

    public function __construct()
    {
        $this->greet = "Hello World!!!";
    }

    public function __toString()
    {
        return $this->greet;
    }
}