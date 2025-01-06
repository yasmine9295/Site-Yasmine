<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250103134903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire CHANGE blog_id blog_id INT NOT NULL');
        $this->addSql('ALTER TABLE defile ADD blogs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE defile ADD CONSTRAINT FK_DEAEFDDE89C05BBC FOREIGN KEY (blogs_id) REFERENCES blog (id)');
        $this->addSql('CREATE INDEX IDX_DEAEFDDE89C05BBC ON defile (blogs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire CHANGE blog_id blog_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE defile DROP FOREIGN KEY FK_DEAEFDDE89C05BBC');
        $this->addSql('DROP INDEX IDX_DEAEFDDE89C05BBC ON defile');
        $this->addSql('ALTER TABLE defile DROP blogs_id');
    }
}
