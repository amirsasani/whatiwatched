<?php

namespace App\Services\Poster;

use App\Models\Title;

class PosterService
{
    private $title;

    public function make()
    {

    }

    /**
     * @param Title $title
     */
    public function setTitle(Title $title): void
    {
        $this->title = $title;
    }


}
