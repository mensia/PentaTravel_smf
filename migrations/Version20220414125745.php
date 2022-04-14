<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220414125745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD hotel_id INT DEFAULT NULL, ADD chambre_id INT DEFAULT NULL, DROP id_hotel');
        $this->addSql('CREATE INDEX IDX_42C849553243BB18 ON reservation (hotel_id)');
        $this->addSql('CREATE INDEX IDX_42C849559B177F54 ON reservation (chambre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF3243BB18');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849553243BB18');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559B177F54');
        $this->addSql('DROP INDEX IDX_42C849553243BB18 ON reservation');
        $this->addSql('DROP INDEX IDX_42C849559B177F54 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD id_hotel INT NOT NULL, DROP hotel_id, DROP chambre_id');
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBD725330D');
        $this->addSql('ALTER TABLE vol_command DROP FOREIGN KEY FK_780BD0D1D725330D');
        $this->addSql('ALTER TABLE vol_command DROP FOREIGN KEY FK_780BD0D19F2BFB7A');
    }
}
