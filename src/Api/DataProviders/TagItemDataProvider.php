<?php
declare(strict_types=1);

namespace App\Api\DataProviders;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Api\Resources\Tag;
use App\Repository\TagRepository;

class TagItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }


    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        $tag = $this->tagRepository->find($id);

        if (null === $tag) {
            return null;
        }

        return new Tag($tag->getId(), $tag->getName());
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Tag::class === $resourceClass;
    }
}
