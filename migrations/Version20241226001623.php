<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241226001623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create new table for districts';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE district (
        id INT AUTO_INCREMENT NOT NULL, 
        code VARCHAR(2) NOT NULL, 
        name VARCHAR(255) NOT NULL, 
        UNIQUE INDEX unique_code (code), 
        PRIMARY KEY(id)
    ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }


    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE district');
    }
}
