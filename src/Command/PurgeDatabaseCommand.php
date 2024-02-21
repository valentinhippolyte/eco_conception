<?php

namespace App\Command;

use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'purge-database',
    description: 'Delete all data from the Database and keep only the last 5.',
)]
class PurgeDatabaseCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('purge-database')
            ->setDescription('Delete all data from the Database and keep only the last 5.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Fetch the five latest game entries
        $latestGames = $this->entityManager->getRepository(Game::class)->findBy([], ['createdAt' => 'DESC'], 5);

        // Delete all games except the latest five
        $deletedCount = $this->entityManager->createQueryBuilder()
            ->delete(Game::class, 'g')
            ->where('g NOT IN (:latestGames)')
            ->setParameter('latestGames', $latestGames)
            ->getQuery()
            ->execute();

        $io->success("Deleted $deletedCount records from the database, keeping only the latest five.");

        return Command::SUCCESS;
    }
}
