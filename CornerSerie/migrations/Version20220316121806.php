<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220316121806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_film (categorie_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_F56D3975BCF5E72D (categorie_id), INDEX IDX_F56D3975567F5183 (film_id), PRIMARY KEY(categorie_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_serie (categorie_id INT NOT NULL, serie_id INT NOT NULL, INDEX IDX_5F427EE4BCF5E72D (categorie_id), INDEX IDX_5F427EE4D94388BD (serie_id), PRIMARY KEY(categorie_id, serie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_film ADD CONSTRAINT FK_F56D3975BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_film ADD CONSTRAINT FK_F56D3975567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_serie ADD CONSTRAINT FK_5F427EE4BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_serie ADD CONSTRAINT FK_5F427EE4D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_film DROP FOREIGN KEY FK_F56D3975BCF5E72D');
        $this->addSql('ALTER TABLE categorie_serie DROP FOREIGN KEY FK_5F427EE4BCF5E72D');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_film');
        $this->addSql('DROP TABLE categorie_serie');
    }
}
