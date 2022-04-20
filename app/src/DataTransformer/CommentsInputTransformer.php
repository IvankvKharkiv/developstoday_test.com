<?php

declare(strict_types=1);

namespace App\DataTransformer;

use App\Entity\Comments;
use App\Repository\CommentsRepository;
use App\Repository\NewsPostsRepository;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CommentsInputTransformer implements \ApiPlatform\Core\DataTransformer\DataTransformerInterface
{
    private EntityManager $entityManager;
    private ParameterBagInterface $parameterBag;
    private RequestStack $requestStack;
    private CommentsRepository $CommentsRepository;
    private NewsPostsRepository $newsPostsRepository;

    public function __construct(
        EntityManager $entityManager,
        ParameterBagInterface $parameterBag,
        RequestStack $requestStack,
        CommentsRepository $CommentsRepository,
        NewsPostsRepository $newsPostsRepository
    ) {
        $this->entityManager = $entityManager;
        $this->parameterBag = $parameterBag;
        $this->requestStack = $requestStack;
        $this->CommentsRepository = $CommentsRepository;
        $this->newsPostsRepository = $newsPostsRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function transform($object, string $to, array $context = [])
    {
        $post = $this->newsPostsRepository->findOneBy(['id' => $object->NewsPosts]);
        if (!$post) {
            throw new \Exception('Post with id = ' . $object->NewsPosts . ' does not exist.');
        }

        $request = $this->requestStack->getCurrentRequest();

        if (!empty($request)) {
            $id = $request->get('id');
            $method = $request->getMethod();
        }

        if ($method === 'POST' || !$id) {
            $comment = new Comments();
        } else {
            $comment = $this->CommentsRepository->findOneBy(['id' => $id]);
        }

        $comment->setauthorName($object->AuthorName);
        $comment->setContent($object->Content);
        $comment->setNewsPosts($post);
        $comment->setCreationDate(new \DateTime());

        return $comment;
    }

    /**
     * {@inheritDoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof Comments) {
            return false;
        }

        return Comments::class === $to && null !== ($context['input']['class'] ?? null);
    }
}
