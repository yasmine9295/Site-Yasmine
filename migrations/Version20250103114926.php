<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250103114926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, defile_id INT DEFAULT NULL, nom_article VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, date DATE NOT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_C0155143712ACCCB (defile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C0155143712ACCCB FOREIGN KEY (defile_id) REFERENCES defile (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCDAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE commentaire_user ADD CONSTRAINT FK_646B121BBA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire_user ADD CONSTRAINT FK_646B121BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE defile CHANGE theme theme VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(1000) NOT NULL');
        $this->addSql('ALTER TABLE marque CHANGE histoire_m histoire_m VARCHAR(3000) NOT NULL, CHANGE image image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCDAE07E97');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C0155143712ACCCB');
        $this->addSql('DROP TABLE blog');
        $this->addSql('ALTER TABLE commentaire_user DROP FOREIGN KEY FK_646B121BBA9CD190');
        $this->addSql('ALTER TABLE commentaire_user DROP FOREIGN KEY FK_646B121BA76ED395');
        $this->addSql('ALTER TABLE defile CHANGE theme theme VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(1000) DEFAULT NULL');
        $this->addSql('ALTER TABLE marque CHANGE histoire_m histoire_m VARCHAR(3000) DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
    }
}
