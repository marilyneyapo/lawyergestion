<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119110111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE renvoi (id INT AUTO_INCREMENT NOT NULL, audience_id INT NOT NULL, date_renvoi DATETIME NOT NULL, motif VARCHAR(255) NOT NULL, INDEX IDX_FB74CF12848CC616 (audience_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE renvoi ADD CONSTRAINT FK_FB74CF12848CC616 FOREIGN KEY (audience_id) REFERENCES audience (id)');
        $this->addSql('ALTER TABLE audience DROP renvois, CHANGE motif motif VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE renvoi DROP FOREIGN KEY FK_FB74CF12848CC616');
        $this->addSql('DROP TABLE renvoi');
        $this->addSql('ALTER TABLE audience ADD renvois JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', CHANGE motif motif VARCHAR(255) NOT NULL');
    }
}