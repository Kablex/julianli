<?php
declare(strict_types=1);

namespace App\Api\Resources;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={"groups"={"post"}})
 */
class Post
{
    /**
     * @ApiProperty(identifier=true)
     *
     * @Groups({"post"})
     */
    public $id;

    /**
     * @var string
     *
     * @Groups({"post"})
     */
    public $title;

    /**
     * @var string
     *
     * @Groups({"post"})
     */
    public $slug;

    /**
     * @var string
     *
     * @Groups({"post"})
     */
    public $content;

    /**
     * @var Tag[]
     *
     * @Groups({"post"})
     */
    public $tags;

    public function __construct(
        ?int $id = null,
        ?string $title = null,
        ?string $slug = null,
        ?string $content = null,
         array  $tags
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
        $this->content = $content;
        $this->tags = $tags;
    }
}
