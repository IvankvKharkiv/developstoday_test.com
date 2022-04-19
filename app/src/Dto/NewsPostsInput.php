<?php

namespace App\Dto;

class NewsPostsInput
{
    /**
     * @var integer
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
     * @var integer|null
     */
    public $amountOfUpvotes;

    /**
     * @var string
     */
    public $authorName;


}