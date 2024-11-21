<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119102244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD adversaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404553E4689F5 FOREIGN KEY (adversaire_id) REFERENCES adversaire (id)');
        $this->addSql('CREATE INDEX IDX_C74404553E4689F5 ON client (adversaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404553E4689F5');
        $this->addSql('DROP INDEX IDX_C74404553E4689F5 ON client');
        $this->addSql('ALTER TABLE client DROP adversaire_id');
    }
}
