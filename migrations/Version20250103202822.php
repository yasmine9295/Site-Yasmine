<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250103202822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog ADD roles JSON NOT NULL, ADD pseudo_u VARCHAR(255) NOT NULL, CHANGE image image VARCHAR(1000) NOT NULL');
        $this->addSql('ALTER TABLE commentaire CHANGE blog_id blog_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog DROP roles, DROP pseudo_u, CHANGE image image VARCHAR(1000) DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire CHANGE blog_id blog_id INT DEFAULT NULL');
    }
}
