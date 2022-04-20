<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Dto\NewsPostsInput;
use App\Repository\NewsPostsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use phpDocumentor\Reflection\Types\False_;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: NewsPostsRepository::class)]
#[ApiResource(
    forceEager: false,
    input: NewsPostsInput::class,
    normalizationContext: ['groups'=>['read']]
)]
class NewsPosts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("read")]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("read")]
    private $link;

    #[ORM\Column(type: 'datetime')]
    #[Groups("read")]
    private $creationDate;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups("read")]
    private $amountOfUpvotes;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups("read")]
    private $authorName;

    #[ORM\OneToMany(mappedBy: "newsPosts", targetEntity: Comments::class, cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("read")]
    private $comments;

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

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    public function upvote () {
        ++$this->amountOfUpvotes;
    }
}
