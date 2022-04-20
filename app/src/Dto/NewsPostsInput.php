<?php

declare(strict_types=1);

namespace App\Dto;

class NewsPostsInput
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string|null
     */
    public $link;

    /**
     * @var string|null
     */
    public $creationDate;

    /**
     * @var int|null
     */
    public $amountOfUpvotes;

    /**
     * @var string
     */
    public $authorName;
}
