<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220318162256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emprunt_film (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, film_id INT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, actif TINYINT(1) NOT NULL, restituer TINYINT(1) NOT NULL, INDEX IDX_CEB1B63CFB88E14F (utilisateur_id), INDEX IDX_CEB1B63C567F5183 (film_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emprunt_serie_saison (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, saison_id INT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, actif TINYINT(1) NOT NULL, restituer TINYINT(1) NOT NULL, INDEX IDX_B5F8DE73FB88E14F (utilisateur_id), INDEX IDX_B5F8DE73F965414C (saison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emprunt_film ADD CONSTRAINT FK_CEB1B63CFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE emprunt_film ADD CONSTRAINT FK_CEB1B63C567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE emprunt_serie_saison ADD CONSTRAINT FK_B5F8DE73FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE emprunt_serie_saison ADD CONSTRAINT FK_B5F8DE73F965414C FOREIGN KEY (saison_id) REFERENCES saison (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE emprunt_film');
        $this->addSql('DROP TABLE emprunt_serie_saison');
    }
}
