<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220413175856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vol ADD agence_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_95C97EBD725330D ON vol (agence_id)');
        $this->addSql('ALTER TABLE vol_command ADD agence_id INT DEFAULT NULL, ADD vol_id INT DEFAULT NULL, DROP id_agence, DROP id_vol');
        $this->addSql('CREATE INDEX IDX_780BD0D1D725330D ON vol_command (agence_id)');
        $this->addSql('CREATE INDEX IDX_780BD0D19F2BFB7A ON vol_command (vol_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBD725330D');
        $this->addSql('DROP INDEX IDX_95C97EBD725330D ON vol');
        $this->addSql('ALTER TABLE vol DROP agence_id');
        $this->addSql('ALTER TABLE vol_command DROP FOREIGN KEY FK_780BD0D1D725330D');
        $this->addSql('ALTER TABLE vol_command DROP FOREIGN KEY FK_780BD0D19F2BFB7A');
        $this->addSql('DROP INDEX IDX_780BD0D1D725330D ON vol_command');
        $this->addSql('DROP INDEX IDX_780BD0D19F2BFB7A ON vol_command');
        $this->addSql('ALTER TABLE vol_command ADD id_agence INT NOT NULL, ADD id_vol INT NOT NULL, DROP agence_id, DROP vol_id');
    }
}
