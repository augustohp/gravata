<?php

namespace Gravata\Service\Gravatar;

class EmailHashCalculator
{
    public function calculate($email)
    {
        $email = trim(strtolower($email));

        return md5($email);
    }
}
