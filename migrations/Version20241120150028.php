<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120150028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE defile CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE image_mannequin ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE image_vetement ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE mannequins CHANGE biographie_m biographie_m VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE defile CHANGE description description VARCHAR(3000) DEFAULT NULL');
        $this->addSql('ALTER TABLE image_mannequin DROP image');
        $this->addSql('ALTER TABLE image_vetement DROP image');
        $this->addSql('ALTER TABLE mannequins CHANGE biographie_m biographie_m VARCHAR(3000) NOT NULL');
    }
}
