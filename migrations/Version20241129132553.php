<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241129132553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455611C0C56');
        $this->addSql('DROP INDEX UNIQ_C7440455611C0C56 ON client');
        $this->addSql('ALTER TABLE client CHANGE dossier_id dossiers_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455651855E8 FOREIGN KEY (dossiers_id) REFERENCES dossier (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455651855E8 ON client (dossiers_id)');
        $this->addSql('ALTER TABLE conclusion ADD dossier_id INT NOT NULL, ADD date_depot DATETIME DEFAULT NULL, ADD deposee TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE conclusion ADD CONSTRAINT FK_1D5819F5611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id)');
        $this->addSql('CREATE INDEX IDX_1D5819F5611C0C56 ON conclusion (dossier_id)');
        $this->addSql('ALTER TABLE dossier DROP conclusion');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455651855E8');
        $this->addSql('DROP INDEX UNIQ_C7440455651855E8 ON client');
        $this->addSql('ALTER TABLE client CHANGE dossiers_id dossier_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455611C0C56 ON client (dossier_id)');
        $this->addSql('ALTER TABLE conclusion DROP FOREIGN KEY FK_1D5819F5611C0C56');
        $this->addSql('DROP INDEX IDX_1D5819F5611C0C56 ON conclusion');
        $this->addSql('ALTER TABLE conclusion DROP dossier_id, DROP date_depot, DROP deposee');
        $this->addSql('ALTER TABLE dossier ADD conclusion VARCHAR(255) NOT NULL');
    }
}
