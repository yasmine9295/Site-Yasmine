<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250326084117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nom_specialisation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog CHANGE image image VARCHAR(1000) NOT NULL');
        $this->addSql('ALTER TABLE mannequins ADD nom_specialisation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mannequins ADD CONSTRAINT FK_277D665834786CC FOREIGN KEY (nom_specialisation_id) REFERENCES nom_specialisation (id)');
        $this->addSql('CREATE INDEX IDX_277D665834786CC ON mannequins (nom_specialisation_id)');
        $this->addSql('ALTER TABLE user CHANGE pseudo pseudo VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mannequins DROP FOREIGN KEY FK_277D665834786CC');
        $this->addSql('DROP TABLE nom_specialisation');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE blog CHANGE image image VARCHAR(1000) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_277D665834786CC ON mannequins');
        $this->addSql('ALTER TABLE mannequins DROP nom_specialisation_id');
        $this->addSql('ALTER TABLE user CHANGE pseudo pseudo VARCHAR(255) DEFAULT NULL');
    }
}
