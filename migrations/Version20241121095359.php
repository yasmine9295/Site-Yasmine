<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241121095359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_mannequin ADD mannequin_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE image_mannequin ADD CONSTRAINT FK_A8CF59709FE83EA9 FOREIGN KEY (mannequin_id_id) REFERENCES mannequins (id)');
        $this->addSql('CREATE INDEX IDX_A8CF59709FE83EA9 ON image_mannequin (mannequin_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_mannequin DROP FOREIGN KEY FK_A8CF59709FE83EA9');
        $this->addSql('DROP INDEX IDX_A8CF59709FE83EA9 ON image_mannequin');
        $this->addSql('ALTER TABLE image_mannequin DROP mannequin_id_id');
    }
}
