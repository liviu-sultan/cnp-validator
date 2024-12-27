<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241227125000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'populate gender_map table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO `symfony-db`.`gender_map` (`gender_id`, `start_date`, `end_date`) VALUES 
                        (1, '1900-01-01 00:00:00', '1999-12-31 23:59:59'),
                        (2, '1900-01-01 00:00:00', '1999-12-31 23:59:59'),
                        (3, '1800-01-01 00:00:00', '1899-12-31 23:59:59'),
                        (4, '1800-01-01 00:00:00', '1899-12-31 23:59:59'),
                        (5, '2000-01-01 00:00:00', '2099-12-31 23:59:59'),
                        (6, '2000-01-01 00:00:00', '2099-12-31 23:59:59')
                        ");

        $this->addSql('INSERT INTO `symfony-db`.`gender_map` (`gender_id`) VALUES (7), (8), (9)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE `gender_map`');
    }
}
