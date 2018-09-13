<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={"groups"={"read"}})
 *
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    public const NUM_ITEMS = 5;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"read"})
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @Groups({"read"})
     *
     * @ORM\Column(name="slug", type="string", length=255)*
     */
    private $slug;

    /**
     * @Groups({"read"})
     *
     * @ORM\Column(name="cover_image_url", type="string", length=255, nullable=true)
     */
    private $coverImageUrl;

    /**
     * @Groups({"read"})
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @Groups({"read"})
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @Groups({"read"})
     *
     * @ORM\Column(name="page_views", type="integer", nullable=true)
     */
    private $pageViews;

    /**
     * @Groups({"read"})
     *
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="posts")
     * @ORM\JoinTable(name="posts_tags")
     */
    private $tags;

    /**
     * @ORM\Column(name="update_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(name="is_published", type="boolean", nullable=true)
     *
     * @var bool
     */
    private $isPublished;

    /**
     * @ORM\Column(name="is_public", type="boolean", nullable=true)
     *
     * @var bool
     */
    private $isPublic;

    /**
     * @Groups({"read"})
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Freelancer", inversedBy="posts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $freelancer;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function pageViewCacheKey(): string
    {
        return \sprintf('post.%s.view', $this->id);
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getCoverImageUrl(): ?string
    {
        return $this->coverImageUrl;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function getFreelancer(): ?Freelancer
    {
        return $this->freelancer;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function getPageViews(): int
    {
        return $this->pageViews ?? 0;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setCoverImageUrl(?string $coverImageUrl): void
    {
        $this->coverImageUrl = $coverImageUrl;
    }

    public function setCreatedAt(?\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setFreelancer(Freelancer $freelancer): void
    {
        $this->freelancer = $freelancer;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setIsPublished(bool $isPublished): void
    {
        $this->isPublished = $isPublished;
    }

    public function setIsPublic(bool $isPublic): void
    {
        $this->isPublic = $isPublic;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    public function setTags(?array $tags): void
    {
        $this->tags = $tags;
    }

    public function setPageViews(int $pageViews): void
    {
        $this->pageViews = $pageViews;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
