<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120100456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, defile_id INT DEFAULT NULL, nom_article VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_C0155143712ACCCB (defile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE defile (id INT AUTO_INCREMENT NOT NULL, marque_id INT DEFAULT NULL, nom_d VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_DEAEFDDE4827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE defile_mannequins (defile_id INT NOT NULL, mannequins_id INT NOT NULL, INDEX IDX_C35C6FE4712ACCCB (defile_id), INDEX IDX_C35C6FE419FD7BBF (mannequins_id), PRIMARY KEY(defile_id, mannequins_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_blog (id INT AUTO_INCREMENT NOT NULL, blog_id INT NOT NULL, INDEX IDX_322FBBDDDAE07E97 (blog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_mannequin (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_vetement (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mannequins (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nationalite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom_m VARCHAR(255) NOT NULL, createur_m VARCHAR(255) NOT NULL, histoire_m VARCHAR(255) NOT NULL, representant_m VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C0155143712ACCCB FOREIGN KEY (defile_id) REFERENCES defile (id)');
        $this->addSql('ALTER TABLE defile ADD CONSTRAINT FK_DEAEFDDE4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE defile_mannequins ADD CONSTRAINT FK_C35C6FE4712ACCCB FOREIGN KEY (defile_id) REFERENCES defile (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE defile_mannequins ADD CONSTRAINT FK_C35C6FE419FD7BBF FOREIGN KEY (mannequins_id) REFERENCES mannequins (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_blog ADD CONSTRAINT FK_322FBBDDDAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E4321D25844');
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E4333B92F39');
        $this->addSql('ALTER TABLE album_style DROP FOREIGN KEY FK_F34D20B8BACD6074');
        $this->addSql('ALTER TABLE album_style DROP FOREIGN KEY FK_F34D20B81137ABCF');
        $this->addSql('ALTER TABLE morceau DROP FOREIGN KEY FK_36BB72081137ABCF');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE album_style');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE label');
        $this->addSql('DROP TABLE morceau');
        $this->addSql('DROP TABLE style');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, artiste_id INT NOT NULL, label_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date INT NOT NULL, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_39986E4321D25844 (artiste_id), INDEX IDX_39986E4333B92F39 (label_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE album_style (style_id INT NOT NULL, album_id INT NOT NULL, INDEX IDX_4505F24CBACD6074 (style_id), INDEX IDX_4505F24C1137ABCF (album_id), PRIMARY KEY(album_id, style_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE artiste (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, site VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE label (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, annee_creation INT NOT NULL, logo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE morceau (id INT AUTO_INCREMENT NOT NULL, album_id INT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, duree VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, piste INT NOT NULL, INDEX IDX_36BB72081137ABCF (album_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, couleur VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E4321D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E4333B92F39 FOREIGN KEY (label_id) REFERENCES label (id)');
        $this->addSql('ALTER TABLE album_style ADD CONSTRAINT FK_F34D20B8BACD6074 FOREIGN KEY (style_id) REFERENCES style (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_style ADD CONSTRAINT FK_F34D20B81137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE morceau ADD CONSTRAINT FK_36BB72081137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C0155143712ACCCB');
        $this->addSql('ALTER TABLE defile DROP FOREIGN KEY FK_DEAEFDDE4827B9B2');
        $this->addSql('ALTER TABLE defile_mannequins DROP FOREIGN KEY FK_C35C6FE4712ACCCB');
        $this->addSql('ALTER TABLE defile_mannequins DROP FOREIGN KEY FK_C35C6FE419FD7BBF');
        $this->addSql('ALTER TABLE image_blog DROP FOREIGN KEY FK_322FBBDDDAE07E97');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE defile');
        $this->addSql('DROP TABLE defile_mannequins');
        $this->addSql('DROP TABLE image_blog');
        $this->addSql('DROP TABLE image_mannequin');
        $this->addSql('DROP TABLE image_vetement');
        $this->addSql('DROP TABLE mannequins');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE utilisateur');
    }
}
