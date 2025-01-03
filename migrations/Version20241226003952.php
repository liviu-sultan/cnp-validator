<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241226003952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'populate district table with district data';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO `symfony-db`.`district` (`code`, `name`) VALUES
        ('01', 'Alba'),
        ('02', 'Arad'),
        ('03', 'Argeș'),
        ('04', 'Bacău'),
        ('05', 'Bihor'),
        ('06', 'Bistrița-Năsăud'),
        ('07', 'Botoșani'),
        ('08', 'Brașov'),
        ('09', 'Brăila'),
        ('10', 'Buzău'),
        ('11', 'Caraș-Severin'),
        ('12', 'Cluj'),
        ('13', 'Constanța'),
        ('14', 'Covasna'),
        ('15', 'Dâmbovița'),
        ('16', 'Dolj'),
        ('17', 'Galați'),
        ('18', 'Gorj'),
        ('19', 'Harghita'),
        ('20', 'Hunedoara'),
        ('21', 'Ialomița'),
        ('22', 'Iași'),
        ('23', 'Ilfov'),
        ('24', 'Maramureș'),
        ('25', 'Mehedinți'),
        ('26', 'Mureș'),
        ('27', 'Neamț'),
        ('28', 'Olt'),
        ('29', 'Prahova'),
        ('30', 'Satu Mare'),
        ('31', 'Sălaj'),
        ('32', 'Sibiu'),
        ('33', 'Suceava'),
        ('34', 'Teleorman'),
        ('35', 'Timiș'),
        ('36', 'Tulcea'),
        ('37', 'Vaslui'),
        ('38', 'Vâlcea'),
        ('39', 'Vrancea'),
        ('40', 'București'),
        ('41', 'București Sector 1'),
        ('42', 'București Sector 2'),
        ('43', 'București Sector 3'),
        ('44', 'București Sector 4'),
        ('45', 'București Sector 5'),
        ('46', 'București Sector 6'),
        ('51', 'Călărași'),
        ('52', 'Giurgiu')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE `district`');
    }
}
