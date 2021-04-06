<?php

namespace App\Classe;

use App\Entity\Category;

class Search {

    /**
     * @var string
     */

    public $string = '';

    
    /**
     * @var Category[]
     */
    public $categories = [];

    public function __toString()
    {
        return $this->string;
    }

    

}





