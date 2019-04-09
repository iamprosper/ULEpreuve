<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190409185321 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_C1765B63FF631228 (etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE epreuves (id INT AUTO_INCREMENT NOT NULL, matiere_id INT NOT NULL, semestre_id INT NOT NULL, file LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', annee DATE NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_DB620E42F46CD258 (matiere_id), INDEX IDX_DB620E425577AFDB (semestre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere_departement (matiere_id INT NOT NULL, departement_id INT NOT NULL, INDEX IDX_F0CA1D07F46CD258 (matiere_id), INDEX IDX_F0CA1D07CCF9E01E (departement_id), PRIMARY KEY(matiere_id, departement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semestre (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B63FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE epreuves ADD CONSTRAINT FK_DB620E42F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE epreuves ADD CONSTRAINT FK_DB620E425577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE matiere_departement ADD CONSTRAINT FK_F0CA1D07F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matiere_departement ADD CONSTRAINT FK_F0CA1D07CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE matiere_departement DROP FOREIGN KEY FK_F0CA1D07CCF9E01E');
        $this->addSql('ALTER TABLE departement DROP FOREIGN KEY FK_C1765B63FF631228');
        $this->addSql('ALTER TABLE epreuves DROP FOREIGN KEY FK_DB620E42F46CD258');
        $this->addSql('ALTER TABLE matiere_departement DROP FOREIGN KEY FK_F0CA1D07F46CD258');
        $this->addSql('ALTER TABLE epreuves DROP FOREIGN KEY FK_DB620E425577AFDB');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE epreuves');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE matiere_departement');
        $this->addSql('DROP TABLE semestre');
    }
}
