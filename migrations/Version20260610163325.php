<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260610163325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT IDENTITY NOT NULL, body VARCHAR(MAX) NOT NULL, headers VARCHAR(MAX) NOT NULL, queue_name NVARCHAR(190) NOT NULL, created_at DATETIME2(6) NOT NULL, available_at DATETIME2(6) NOT NULL, delivered_at DATETIME2(6), PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 ON messenger_messages (queue_name, available_at, delivered_at, id)');
        $this->addSql('ALTER TABLE LECON DROP CONSTRAINT FK_lecon_calendrier');
        $this->addSql('ALTER TABLE LECON DROP CONSTRAINT FK_lecon_eleve');
        $this->addSql('ALTER TABLE LECON DROP CONSTRAINT FK_lecon_modele');
        $this->addSql('ALTER TABLE LECON DROP CONSTRAINT FK_lecon_moniteur');
        $this->addSql('DROP INDEX PK_LECON ON LECON');
        $this->addSql('ALTER TABLE LECON ADD id INT IDENTITY NOT NULL');
        $this->addSql('ALTER TABLE LECON ADD CONSTRAINT FK_94E6242EB872B55D FOREIGN KEY (lecon_date_heure) REFERENCES calendrier (date_heure)');
        $this->addSql('ALTER TABLE LECON ADD CONSTRAINT FK_94E6242EF5247037 FOREIGN KEY (lecon_eleve_id) REFERENCES eleve (id_eleve)');
        $this->addSql('ALTER TABLE LECON ADD CONSTRAINT FK_94E6242E30F029D4 FOREIGN KEY (lecon_modele_vehic) REFERENCES modele (modele_vehic)');
        $this->addSql('ALTER TABLE LECON ADD CONSTRAINT FK_94E6242E96498D9A FOREIGN KEY (lecon_moniteur_id) REFERENCES moniteur (id_moniteur)');
        $this->addSql('ALTER TABLE LECON ADD PRIMARY KEY (id)');
        $this->addSql('EXEC [sp_rename] N\'LECON.idx_63b2e69eb872b55d\', N\'IDX_94E6242EB872B55D\', N\'INDEX\'');
        $this->addSql('EXEC [sp_rename] N\'LECON.idx_63b2e69ef5247037\', N\'IDX_94E6242EF5247037\', N\'INDEX\'');
        $this->addSql('EXEC [sp_rename] N\'LECON.idx_63b2e69e30f029d4\', N\'IDX_94E6242E30F029D4\', N\'INDEX\'');
        $this->addSql('EXEC [sp_rename] N\'LECON.idx_63b2e69e96498d9a\', N\'IDX_94E6242E96498D9A\', N\'INDEX\'');
        $this->addSql('ALTER TABLE MODELE ALTER COLUMN annee NVARCHAR(4) NOT NULL');
        $this->addSql('ALTER TABLE VEHICULE DROP CONSTRAINT FK_Vehicule_Modele');
        $this->addSql('ALTER TABLE VEHICULE ADD CONSTRAINT FK_292FFF1D3FC4ADC8 FOREIGN KEY (modele_vehic) REFERENCES modele (modele_vehic)');
        $this->addSql('EXEC [sp_rename] N\'VEHICULE.idx_ef1c63513fc4adc8\', N\'IDX_292FFF1D3FC4ADC8\', N\'INDEX\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE lecon DROP CONSTRAINT FK_94E6242EB872B55D');
        $this->addSql('ALTER TABLE lecon DROP CONSTRAINT FK_94E6242EF5247037');
        $this->addSql('ALTER TABLE lecon DROP CONSTRAINT FK_94E6242E30F029D4');
        $this->addSql('ALTER TABLE lecon DROP CONSTRAINT FK_94E6242E96498D9A');
        $this->addSql('DROP INDEX [primary] ON lecon');
        $this->addSql('ALTER TABLE lecon DROP COLUMN id');
        $this->addSql('ALTER TABLE lecon ADD CONSTRAINT FK_lecon_calendrier FOREIGN KEY (lecon_date_heure) REFERENCES CALENDRIER (date_heure) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lecon ADD CONSTRAINT FK_lecon_eleve FOREIGN KEY (lecon_eleve_id) REFERENCES ELEVE (id_eleve) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lecon ADD CONSTRAINT FK_lecon_modele FOREIGN KEY (lecon_modele_vehic) REFERENCES MODELE (modele_vehic) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lecon ADD CONSTRAINT FK_lecon_moniteur FOREIGN KEY (lecon_moniteur_id) REFERENCES MONITEUR (id_moniteur) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lecon ADD PRIMARY KEY (lecon_modele_vehic, lecon_date_heure, lecon_eleve_id, lecon_moniteur_id)');
        $this->addSql('EXEC [sp_rename] N\'lecon.idx_94e6242eb872b55d\', N\'IDX_63B2E69EB872B55D\', N\'INDEX\'');
        $this->addSql('EXEC [sp_rename] N\'lecon.idx_94e6242ef5247037\', N\'IDX_63B2E69EF5247037\', N\'INDEX\'');
        $this->addSql('EXEC [sp_rename] N\'lecon.idx_94e6242e30f029d4\', N\'IDX_63B2E69E30F029D4\', N\'INDEX\'');
        $this->addSql('EXEC [sp_rename] N\'lecon.idx_94e6242e96498d9a\', N\'IDX_63B2E69E96498D9A\', N\'INDEX\'');
        $this->addSql('ALTER TABLE modele ALTER COLUMN annee NCHAR(4) NOT NULL');
        $this->addSql('ALTER TABLE vehicule DROP CONSTRAINT FK_292FFF1D3FC4ADC8');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_Vehicule_Modele FOREIGN KEY (modele_vehic) REFERENCES MODELE (modele_vehic) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('EXEC [sp_rename] N\'vehicule.idx_292fff1d3fc4adc8\', N\'IDX_EF1C63513FC4ADC8\', N\'INDEX\'');
    }
}
