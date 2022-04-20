<?php

declare(strict_types=1);

namespace App\DataTransformer;

use App\Entity\NewsPosts;
use App\Repository\NewsPostsRepository;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class NewsPostsInputDataTransformer implements \ApiPlatform\Core\DataTransformer\DataTransformerInterface
{
    private EntityManager $entityManager;
    private ParameterBagInterface $parameterBag;
    private RequestStack $requestStack;
    private NewsPostsRepository $newsPostsRepository;

    public function __construct(
        EntityManager $entityManager,
        ParameterBagInterface $parameterBag,
        RequestStack $requestStack,
        NewsPostsRepository $newsPostsRepository
    ) {
        $this->entityManager = $entityManager;
        $this->parameterBag = $parameterBag;
        $this->requestStack = $requestStack;
        $this->newsPostsRepository = $newsPostsRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function transform($object, string $to, array $context = [])
    {
        $request = $this->requestStack->getCurrentRequest();

        if (!empty($request)) {
            $id = $request->get('id');
            $method = $request->getMethod();
        }

        if ($method === 'PUT' && $request->get('upvote') && $id) {
            $newsPost = $this->newsPostsRepository->findOneBy(['id' => $id]);
            $newsPost->upvote();

            return $newsPost;
        }

        if ($method === 'POST' || !$id) {
            $newsPost = new NewsPosts();
        } else {
            $newsPost = $this->newsPostsRepository->findOneBy(['id' => $id]);
        }

        $newsPost->setTitle($object->title);
        $newsPost->setLink($object->link ?: $this->parameterBag->get('app.baseurl') . 'api/news_posts/');
        $newsPost->setAuthorName($object->authorName);
        $newsPost->setAmountOfUpvotes($object->amountOfUpvotes ? $object->amountOfUpvotes : 0);
        $date = \DateTime::createFromFormat(\DateTime::RFC3339, $object->creationDate);
        $newsPost->setCreationDate($date ?: new \DateTime());
        if (!$object->link) {
            $this->entityManager->persist($newsPost);
            $newsPost->setLink($newsPost->getLink() . $newsPost->getId());
        }

        $this->entityManager->persist($newsPost);
        $this->entityManager->flush();

        return $newsPost;
    }

    /**
     * {@inheritDoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof NewsPosts) {
            return false;
        }

        return NewsPosts::class === $to && null !== ($context['input']['class'] ?? null);
    }
}
