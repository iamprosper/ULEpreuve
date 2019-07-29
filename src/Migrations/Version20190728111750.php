<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190728111750 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE affiche (id INT AUTO_INCREMENT NOT NULL, auteur_id INT DEFAULT NULL, departement_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, detail LONGTEXT DEFAULT NULL, create_at DATETIME NOT NULL, update_at DATETIME NOT NULL, INDEX IDX_E4314F0D60BB6FE6 (auteur_id), INDEX IDX_E4314F0DCCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE affiche_file (id INT AUTO_INCREMENT NOT NULL, affiche_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_F5E6739E48A60577 (affiche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, auteur_id INT NOT NULL, affiche_id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, message LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, update_at DATETIME NOT NULL, INDEX IDX_9474526C60BB6FE6 (auteur_id), INDEX IDX_9474526C48A60577 (affiche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_C1765B63FF631228 (etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE epreuves (id INT AUTO_INCREMENT NOT NULL, matiere_id INT NOT NULL, semestre_id INT NOT NULL, type_id INT NOT NULL, file VARCHAR(255) NOT NULL, annee VARCHAR(255) NOT NULL, INDEX IDX_DB620E42F46CD258 (matiere_id), INDEX IDX_DB620E425577AFDB (semestre_id), INDEX IDX_DB620E42C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, departement_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_9014574ACCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semestre (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_evaluation (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, liker_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, created_at DATETIME NOT NULL, uptodate_at DATETIME NOT NULL, password VARCHAR(255) NOT NULL, confirm_password VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, sexe TINYINT(1) NOT NULL, INDEX IDX_957A6479979F103A (liker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affiche ADD CONSTRAINT FK_E4314F0D60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE affiche ADD CONSTRAINT FK_E4314F0DCCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE affiche_file ADD CONSTRAINT FK_F5E6739E48A60577 FOREIGN KEY (affiche_id) REFERENCES affiche (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C48A60577 FOREIGN KEY (affiche_id) REFERENCES affiche (id)');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B63FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE epreuves ADD CONSTRAINT FK_DB620E42F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE epreuves ADD CONSTRAINT FK_DB620E425577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE epreuves ADD CONSTRAINT FK_DB620E42C54C8C93 FOREIGN KEY (type_id) REFERENCES type_evaluation (id)');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574ACCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479979F103A FOREIGN KEY (liker_id) REFERENCES affiche (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE affiche_file DROP FOREIGN KEY FK_F5E6739E48A60577');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C48A60577');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479979F103A');
        $this->addSql('ALTER TABLE affiche DROP FOREIGN KEY FK_E4314F0DCCF9E01E');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574ACCF9E01E');
        $this->addSql('ALTER TABLE departement DROP FOREIGN KEY FK_C1765B63FF631228');
        $this->addSql('ALTER TABLE epreuves DROP FOREIGN KEY FK_DB620E42F46CD258');
        $this->addSql('ALTER TABLE epreuves DROP FOREIGN KEY FK_DB620E425577AFDB');
        $this->addSql('ALTER TABLE epreuves DROP FOREIGN KEY FK_DB620E42C54C8C93');
        $this->addSql('ALTER TABLE affiche DROP FOREIGN KEY FK_E4314F0D60BB6FE6');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C60BB6FE6');
        $this->addSql('DROP TABLE affiche');
        $this->addSql('DROP TABLE affiche_file');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE epreuves');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE semestre');
        $this->addSql('DROP TABLE type_evaluation');
        $this->addSql('DROP TABLE fos_user');
    }
}
