<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220413230516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre ADD hotel_id INT DEFAULT NULL, DROP id_hotel');
        $this->addSql('CREATE INDEX IDX_C509E4FF3243BB18 ON chambre (hotel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF3243BB18');
        $this->addSql('DROP INDEX IDX_C509E4FF3243BB18 ON chambre');
        $this->addSql('ALTER TABLE chambre ADD id_hotel INT NOT NULL, DROP hotel_id');
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBD725330D');
        $this->addSql('ALTER TABLE vol_command DROP FOREIGN KEY FK_780BD0D1D725330D');
        $this->addSql('ALTER TABLE vol_command DROP FOREIGN KEY FK_780BD0D19F2BFB7A');
    }
}
