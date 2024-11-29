<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241129130837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adversaire (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, code VARCHAR(255) DEFAULT NULL, raison_social VARCHAR(255) DEFAULT NULL, contact VARCHAR(255) DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, tel VARCHAR(255) DEFAULT NULL, cel VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_7344F47A19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audience (id INT AUTO_INCREMENT NOT NULL, dossier_id INT NOT NULL, juridiction_id INT NOT NULL, chambre_id INT NOT NULL, adversaire_id INT NOT NULL, conseil VARCHAR(255) NOT NULL, date DATETIME NOT NULL, motif VARCHAR(255) DEFAULT NULL, INDEX IDX_FDCD9418611C0C56 (dossier_id), INDEX IDX_FDCD9418D38DB6BD (juridiction_id), INDEX IDX_FDCD94189B177F54 (chambre_id), INDEX IDX_FDCD94183E4689F5 (adversaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, juridiction_id INT NOT NULL, nom VARCHAR(255) NOT NULL, greffiers JSON NOT NULL COMMENT \'(DC2Type:json)\', president VARCHAR(255) NOT NULL, INDEX IDX_C509E4FFD38DB6BD (juridiction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, dossier_id INT NOT NULL, code VARCHAR(255) NOT NULL, roles_client VARCHAR(255) DEFAULT NULL, raisonso VARCHAR(255) DEFAULT NULL, fax VARCHAR(255) DEFAULT NULL, typecli VARCHAR(255) DEFAULT NULL, profil VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C7440455611C0C56 (dossier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colab (id INT NOT NULL, typecolab VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conclusion (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, conclusion VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3D48E037F55AE19E (numero), UNIQUE INDEX UNIQ_3D48E03719EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE juridiction (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE procedures (id INT AUTO_INCREMENT NOT NULL, dossier_id INT NOT NULL, date DATETIME NOT NULL, type VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_969AFE42611C0C56 (dossier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE renvoi (id INT AUTO_INCREMENT NOT NULL, audience_id INT NOT NULL, date_renvoi DATETIME NOT NULL, motif VARCHAR(255) NOT NULL, INDEX IDX_FB74CF12848CC616 (audience_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, cel VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adversaire ADD CONSTRAINT FK_7344F47A19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE audience ADD CONSTRAINT FK_FDCD9418611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id)');
        $this->addSql('ALTER TABLE audience ADD CONSTRAINT FK_FDCD9418D38DB6BD FOREIGN KEY (juridiction_id) REFERENCES juridiction (id)');
        $this->addSql('ALTER TABLE audience ADD CONSTRAINT FK_FDCD94189B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE audience ADD CONSTRAINT FK_FDCD94183E4689F5 FOREIGN KEY (adversaire_id) REFERENCES adversaire (id)');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FFD38DB6BD FOREIGN KEY (juridiction_id) REFERENCES juridiction (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE colab ADD CONSTRAINT FK_E5627503BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dossier ADD CONSTRAINT FK_3D48E03719EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE procedures ADD CONSTRAINT FK_969AFE42611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id)');
        $this->addSql('ALTER TABLE renvoi ADD CONSTRAINT FK_FB74CF12848CC616 FOREIGN KEY (audience_id) REFERENCES audience (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adversaire DROP FOREIGN KEY FK_7344F47A19EB6921');
        $this->addSql('ALTER TABLE audience DROP FOREIGN KEY FK_FDCD9418611C0C56');
        $this->addSql('ALTER TABLE audience DROP FOREIGN KEY FK_FDCD9418D38DB6BD');
        $this->addSql('ALTER TABLE audience DROP FOREIGN KEY FK_FDCD94189B177F54');
        $this->addSql('ALTER TABLE audience DROP FOREIGN KEY FK_FDCD94183E4689F5');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FFD38DB6BD');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455611C0C56');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE colab DROP FOREIGN KEY FK_E5627503BF396750');
        $this->addSql('ALTER TABLE dossier DROP FOREIGN KEY FK_3D48E03719EB6921');
        $this->addSql('ALTER TABLE procedures DROP FOREIGN KEY FK_969AFE42611C0C56');
        $this->addSql('ALTER TABLE renvoi DROP FOREIGN KEY FK_FB74CF12848CC616');
        $this->addSql('DROP TABLE adversaire');
        $this->addSql('DROP TABLE audience');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE colab');
        $this->addSql('DROP TABLE conclusion');
        $this->addSql('DROP TABLE dossier');
        $this->addSql('DROP TABLE juridiction');
        $this->addSql('DROP TABLE procedures');
        $this->addSql('DROP TABLE renvoi');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE user');
    }
}
