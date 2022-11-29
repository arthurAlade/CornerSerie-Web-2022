<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315181235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE serie_personne_acteur (serie_id INT NOT NULL, personne_id INT NOT NULL, INDEX IDX_CD409661D94388BD (serie_id), INDEX IDX_CD409661A21BD112 (personne_id), PRIMARY KEY(serie_id, personne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_personne_realisateur (serie_id INT NOT NULL, personne_id INT NOT NULL, INDEX IDX_BEF52582D94388BD (serie_id), INDEX IDX_BEF52582A21BD112 (personne_id), PRIMARY KEY(serie_id, personne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE serie_personne_acteur ADD CONSTRAINT FK_CD409661D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_personne_acteur ADD CONSTRAINT FK_CD409661A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_personne_realisateur ADD CONSTRAINT FK_BEF52582D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_personne_realisateur ADD CONSTRAINT FK_BEF52582A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE serie_personne_acteur');
        $this->addSql('DROP TABLE serie_personne_realisateur');
    }
}
