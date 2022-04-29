<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220429031038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favoriet (id INT AUTO_INCREMENT NOT NULL, agence_id INT NOT NULL, user INT NOT NULL, INDEX IDX_51AC8D3BD725330D (agence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favoriet ADD CONSTRAINT FK_51AC8D3BD725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE favoriet');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF3243BB18');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849553243BB18');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559B177F54');
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBD725330D');
        $this->addSql('ALTER TABLE vol_command DROP FOREIGN KEY FK_780BD0D1D725330D');
        $this->addSql('ALTER TABLE vol_command DROP FOREIGN KEY FK_780BD0D19F2BFB7A');
    }
}
