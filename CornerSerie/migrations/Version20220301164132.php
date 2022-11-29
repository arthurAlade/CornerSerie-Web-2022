<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301164132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_personne_realisateur (film_id INT NOT NULL, personne_id INT NOT NULL, INDEX IDX_AD490686567F5183 (film_id), INDEX IDX_AD490686A21BD112 (personne_id), PRIMARY KEY(film_id, personne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_personne_realisateur ADD CONSTRAINT FK_AD490686567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_personne_realisateur ADD CONSTRAINT FK_AD490686A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');

        $this->addSql('CREATE TABLE film_personne_producteur (film_id INT NOT NULL, personne_id INT NOT NULL, INDEX IDX_FP1 (film_id), INDEX  IDX_FP2(personne_id), PRIMARY KEY (film_id, personne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_personne_producteur ADD CONSTRAINT FK_film_producteur_film FOREIGN KEY (film_id) REFERENCES film(id) ON DELETE CASCADE ');
        $this->addSql('ALTER TABLE film_personne_producteur ADD CONSTRAINT FK_film_producteur_personne FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE ');

        $this->addSql('CREATE TABLE film_personne_acteur (film_id INT NOT NULL , personne_id INT NOT NULL, INDEX IDX_FA1 (film_id), INDEX IDX_FA2 (personne_id), PRIMARY KEY (film_id, personne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_personne_acteur ADD CONSTRAINT FK_film_acteur_film FOREIGN KEY (film_id) REFERENCES film(id) ON DELETE CASCADE ');
        $this->addSql('ALTER TABLE film_personne_acteur ADD CONSTRAINT FK_film_acteur_personne FOREIGN KEY (personne_id) REFERENCES personne(id) ON DELETE CASCADE ');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE film_personne_realisateur');
        $this->addSql('DROP TABLE film_personne_producteur');
        $this->addSql('DROP TABLE film_personne_acteur');
    }
}
