<?php

namespace taxi\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class taxiUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
