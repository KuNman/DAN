<?php

namespace AppBundle\Service;

use Symfony\Component\BrowserKit\Request;

class WallParser
{

    public function Parse($request) {
        return $_POST["search-bar"];
    }

}