<?php
declare(strict_types=1);

namespace App\Api\DataProviders;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Api\Resources\Tag;
use App\Repository\TagRepository;

class TagCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getCollection(string $resourceClass, string $operationName = null): iterable
    {
        $tags = $this->tagRepository->findAll();

        if (\count($tags) === 0) {
            return [];
        }

        /** @var \App\Entity\Tag $tag */
        foreach ($tags as $tag) {
            yield new Tag($tag->getId(), $tag->getName());
        }
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Tag::class === $resourceClass;
    }
}
