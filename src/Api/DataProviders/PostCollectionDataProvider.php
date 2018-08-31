<?php
declare(strict_types=1);

namespace App\Api\DataProviders;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Api\Resources\Post;
use App\Api\Resources\Tag;
use App\Repository\PostRepository;

class PostCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getCollection(string $resourceClass, string $operationName = null): iterable
    {
        $posts = $this->postRepository->findAll();

        if (\count($posts) === 0) {
            return [];
        }

        /** @var \App\Entity\Post $post */
        foreach ($posts as $post) {
            $tags = [];

            /** @var \App\Entity\Tag $tag */
            foreach ($post->getTags() as $tag) {
                $tags[] = new Tag($tag->getId(), $tag->getName());
            }

            yield new Post(
                $post->getId(),
                $post->getTitle(),
                $post->getSlug(),
                $post->getContent(),
                $tags
            );
        }
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Post::class === $resourceClass;
    }
}
