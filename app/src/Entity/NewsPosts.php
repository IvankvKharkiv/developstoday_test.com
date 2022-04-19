<?php

namespace App\Entity;

use App\Dto\NewsPostsInput;
use App\Repository\NewsPostsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NewsPostsRepository::class)]
#[ApiResource(input: NewsPostsInput::class)]
class NewsPosts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $link;

    #[ORM\Column(type: 'datetime')]
    private $creationDate;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $amountOfUpvotes;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $authorName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }


    /**
     * @param \DateTimeInterface|null $creationDate
     * @return $this
     */
    public function setCreationDate(\DateTimeInterface|null $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getAmountOfUpvotes(): ?int
    {
        return $this->amountOfUpvotes;
    }

    public function setAmountOfUpvotes(?int $amountOfUpvotes): self
    {
        $this->amountOfUpvotes = $amountOfUpvotes;

        return $this;
    }

    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    public function setAuthorName(?string $authorName): self
    {
        $this->authorName = $authorName;

        return $this;
    }
}
