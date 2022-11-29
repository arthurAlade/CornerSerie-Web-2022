<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315175618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE saison (id INT AUTO_INCREMENT NOT NULL, serie_id INT NOT NULL, numero INT NOT NULL, nb_episodes INT DEFAULT NULL, affiche VARCHAR(255) DEFAULT NULL, synopsis LONGTEXT DEFAULT NULL, INDEX IDX_C0D0D586D94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE saison ADD CONSTRAINT FK_C0D0D586D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE film_personne_realisateur DROP FOREIGN KEY FK_AD490686A21BD112');
        $this->addSql('ALTER TABLE film_personne_realisateur DROP FOREIGN KEY FK_AD490686567F5183');
        $this->addSql('DROP INDEX idx_ad490686567f5183 ON film_personne_realisateur');
        $this->addSql('CREATE INDEX IDX_925C592567F5183 ON film_personne_realisateur (film_id)');
        $this->addSql('DROP INDEX idx_ad490686a21bd112 ON film_personne_realisateur');
        $this->addSql('CREATE INDEX IDX_925C592A21BD112 ON film_personne_realisateur (personne_id)');
        $this->addSql('ALTER TABLE film_personne_realisateur ADD CONSTRAINT FK_AD490686A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_personne_realisateur ADD CONSTRAINT FK_AD490686567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_personne_producteur DROP FOREIGN KEY FK_film_producteur_personne');
        $this->addSql('ALTER TABLE film_personne_producteur DROP FOREIGN KEY FK_film_producteur_film');
        $this->addSql('DROP INDEX idx_fp1 ON film_personne_producteur');
        $this->addSql('CREATE INDEX IDX_CCA3D6F2567F5183 ON film_personne_producteur (film_id)');
        $this->addSql('DROP INDEX idx_fp2 ON film_personne_producteur');
        $this->addSql('CREATE INDEX IDX_CCA3D6F2A21BD112 ON film_personne_producteur (personne_id)');
        $this->addSql('ALTER TABLE film_personne_producteur ADD CONSTRAINT FK_film_producteur_personne FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_personne_producteur ADD CONSTRAINT FK_film_producteur_film FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_personne_acteur DROP FOREIGN KEY FK_film_acteur_personne');
        $this->addSql('ALTER TABLE film_personne_acteur DROP FOREIGN KEY FK_film_acteur_film');
        $this->addSql('DROP INDEX idx_fa1 ON film_personne_acteur');
        $this->addSql('CREATE INDEX IDX_C4B4F3D4567F5183 ON film_personne_acteur (film_id)');
        $this->addSql('DROP INDEX idx_fa2 ON film_personne_acteur');
        $this->addSql('CREATE INDEX IDX_C4B4F3D4A21BD112 ON film_personne_acteur (personne_id)');
        $this->addSql('ALTER TABLE film_personne_acteur ADD CONSTRAINT FK_film_acteur_personne FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_personne_acteur ADD CONSTRAINT FK_film_acteur_film FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE saison DROP FOREIGN KEY FK_C0D0D586D94388BD');
        $this->addSql('DROP TABLE saison');
        $this->addSql('DROP TABLE serie');
        $this->addSql('ALTER TABLE film_personne_acteur DROP FOREIGN KEY FK_C4B4F3D4567F5183');
        $this->addSql('ALTER TABLE film_personne_acteur DROP FOREIGN KEY FK_C4B4F3D4A21BD112');
        $this->addSql('DROP INDEX idx_c4b4f3d4567f5183 ON film_personne_acteur');
        $this->addSql('CREATE INDEX IDX_FA1 ON film_personne_acteur (film_id)');
        $this->addSql('DROP INDEX idx_c4b4f3d4a21bd112 ON film_personne_acteur');
        $this->addSql('CREATE INDEX IDX_FA2 ON film_personne_acteur (personne_id)');
        $this->addSql('ALTER TABLE film_personne_acteur ADD CONSTRAINT FK_C4B4F3D4567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_personne_acteur ADD CONSTRAINT FK_C4B4F3D4A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_personne_producteur DROP FOREIGN KEY FK_CCA3D6F2567F5183');
        $this->addSql('ALTER TABLE film_personne_producteur DROP FOREIGN KEY FK_CCA3D6F2A21BD112');
        $this->addSql('DROP INDEX idx_cca3d6f2567f5183 ON film_personne_producteur');
        $this->addSql('CREATE INDEX IDX_FP1 ON film_personne_producteur (film_id)');
        $this->addSql('DROP INDEX idx_cca3d6f2a21bd112 ON film_personne_producteur');
        $this->addSql('CREATE INDEX IDX_FP2 ON film_personne_producteur (personne_id)');
        $this->addSql('ALTER TABLE film_personne_producteur ADD CONSTRAINT FK_CCA3D6F2567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_personne_producteur ADD CONSTRAINT FK_CCA3D6F2A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_personne_realisateur DROP FOREIGN KEY FK_925C592567F5183');
        $this->addSql('ALTER TABLE film_personne_realisateur DROP FOREIGN KEY FK_925C592A21BD112');
        $this->addSql('DROP INDEX idx_925c592567f5183 ON film_personne_realisateur');
        $this->addSql('CREATE INDEX IDX_AD490686567F5183 ON film_personne_realisateur (film_id)');
        $this->addSql('DROP INDEX idx_925c592a21bd112 ON film_personne_realisateur');
        $this->addSql('CREATE INDEX IDX_AD490686A21BD112 ON film_personne_realisateur (personne_id)');
        $this->addSql('ALTER TABLE film_personne_realisateur ADD CONSTRAINT FK_925C592567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_personne_realisateur ADD CONSTRAINT FK_925C592A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
    }
}
