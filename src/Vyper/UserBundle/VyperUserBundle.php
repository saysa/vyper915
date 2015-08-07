<?php

namespace Vyper\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VyperUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
