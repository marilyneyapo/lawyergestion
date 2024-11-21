<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241118195035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adversaire CHANGE client_id client_id INT NOT NULL');
        $this->addSql('DROP INDEX adversaire_id_index ON client');
        $this->addSql('ALTER TABLE client DROP adversaire_id, CHANGE dossier_id dossier_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adversaire CHANGE client_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD adversaire_id VARCHAR(255) NOT NULL, CHANGE dossier_id dossier_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX adversaire_id_index ON client (adversaire_id)');
    }
}
