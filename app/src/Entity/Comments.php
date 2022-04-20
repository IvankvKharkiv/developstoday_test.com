<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Dto\CommentsInput;
use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
#[ApiResource(input: CommentsInput::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: NewsPosts::class, inversedBy: "comments")]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("read")]
    private $newsPosts;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("read")]
    private $authorName;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("read")]
    private $content;

    #[ORM\Column(type: 'datetime')]
    #[Groups("read")]
    private $creationDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNewsPosts(): ?NewsPosts
    {
        return $this->newsPosts;
    }

    public function setNewsPosts(?NewsPosts $newsPosts): self
    {
        $this->newsPosts = $newsPosts;

        return $this;
    }

    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    public function setAuthorName(string $authorName): self
    {
        $this->authorName = $authorName;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $Content): self
    {
        $this->content = $Content;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }
}
