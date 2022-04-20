<?php

declare(strict_types=1);

namespace App\Command;

use App\Repository\NewsPostsRepository;
use ProxyManager\Exception\ExceptionInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:reset_votes-gnome',
    description: 'Resets all apvotes fror all news posts. (All news posts = 0)',
)]
class ResetVotesGnomeCommand extends Command
{
    private NewsPostsRepository $newsPostsRepository;

    public function __construct(NewsPostsRepository $newsPostsRepository, string $name = null)
    {
        $this->newsPostsRepository = $newsPostsRepository;
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->newsPostsRepository->resetUpvotes();
        } catch (ExceptionInterface $exceptione) {
            $io->error($exceptione->getMessage());

            return Command::FAILURE;
        }

        $io->success('You successfully have reseted all votes for all posts.');

        return Command::SUCCESS;
    }
}
