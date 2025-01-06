<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250102185732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, blog_id INT DEFAULT NULL, contenu_commentaire VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_67F068BCDAE07E97 (blog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire_user (commentaire_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_646B121BBA9CD190 (commentaire_id), INDEX IDX_646B121BA76ED395 (user_id), PRIMARY KEY(commentaire_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCDAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE commentaire_user ADD CONSTRAINT FK_646B121BBA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire_user ADD CONSTRAINT FK_646B121BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE marque CHANGE histoire_m histoire_m VARCHAR(3000) NOT NULL, CHANGE image image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCDAE07E97');
        $this->addSql('ALTER TABLE commentaire_user DROP FOREIGN KEY FK_646B121BBA9CD190');
        $this->addSql('ALTER TABLE commentaire_user DROP FOREIGN KEY FK_646B121BA76ED395');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE commentaire_user');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C0155143712ACCCB');
        $this->addSql('ALTER TABLE defile DROP FOREIGN KEY FK_DEAEFDDE59027487');
        $this->addSql('DROP INDEX IDX_DEAEFDDE59027487 ON defile');
        $this->addSql('ALTER TABLE marque CHANGE histoire_m histoire_m VARCHAR(3000) DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
    }
}
