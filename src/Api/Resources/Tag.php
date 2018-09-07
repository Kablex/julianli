<?php
declare(strict_types=1);

namespace App\Api\Resources;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource
 */
class Tag
{
    /**
     * @ApiProperty(identifier=true)
     *
     * @Groups({"post"})
     *
     * @var null|int
     */
    public $id;

    /**
     * @Groups({"post"})
     *
     * @var null|string
     */
    public $name;

    public function __construct(?int $id = null, ?string $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
