<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241121095614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_vetement ADD defile_id INT NOT NULL');
        $this->addSql('ALTER TABLE image_vetement ADD CONSTRAINT FK_B344C867712ACCCB FOREIGN KEY (defile_id) REFERENCES defile (id)');
        $this->addSql('CREATE INDEX IDX_B344C867712ACCCB ON image_vetement (defile_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_vetement DROP FOREIGN KEY FK_B344C867712ACCCB');
        $this->addSql('DROP INDEX IDX_B344C867712ACCCB ON image_vetement');
        $this->addSql('ALTER TABLE image_vetement DROP defile_id');
    }
}
