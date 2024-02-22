<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240219134225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Vich image fields needed';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE game ADD image_name VARCHAR(255) DEFAULT NULL, ADD image_size INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE description description LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE game DROP image_name, DROP image_size, DROP created_at, DROP updated_at, CHANGE description description TEXT NOT NULL');
    }
}
