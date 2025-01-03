<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250103132645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE defile_blog (defile_id INT NOT NULL, blog_id INT NOT NULL, INDEX IDX_13A4B6E1712ACCCB (defile_id), INDEX IDX_13A4B6E1DAE07E97 (blog_id), PRIMARY KEY(defile_id, blog_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE defile_blog ADD CONSTRAINT FK_13A4B6E1712ACCCB FOREIGN KEY (defile_id) REFERENCES defile (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE defile_blog ADD CONSTRAINT FK_13A4B6E1DAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE defile_blog DROP FOREIGN KEY FK_13A4B6E1712ACCCB');
        $this->addSql('ALTER TABLE defile_blog DROP FOREIGN KEY FK_13A4B6E1DAE07E97');
        $this->addSql('DROP TABLE defile_blog');
    }
}
