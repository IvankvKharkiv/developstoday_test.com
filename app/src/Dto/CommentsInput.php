<?php

declare(strict_types=1);

namespace App\Dto;

class CommentsInput
{
    /**
     * @var int
     */
    public $NewsPosts;

    /**
     * @var string
     */
    public $AuthorName;

    /**
     * @var string
     */
    public $Content;
}
