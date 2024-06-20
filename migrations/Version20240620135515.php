<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240620135515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprises ADD roles JSON NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD secteur_activite VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, DROP entr_tel, DROP entr_nom, DROP entr_secteur_activite, DROP entr_nombre_employe, CHANGE entr_mail entr_mail VARCHAR(180) NOT NULL, CHANGE entr_password password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_56B1B7A9A1701170 ON entreprises (entr_mail)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_56B1B7A9A1701170 ON entreprises');
        $this->addSql('ALTER TABLE entreprises ADD entr_password VARCHAR(255) NOT NULL, ADD entr_tel INT NOT NULL, ADD entr_nom VARCHAR(50) NOT NULL, ADD entr_secteur_activite VARCHAR(50) NOT NULL, ADD entr_nombre_employe VARCHAR(20) NOT NULL, DROP roles, DROP password, DROP nom, DROP secteur_activite, DROP adresse, CHANGE entr_mail entr_mail VARCHAR(100) NOT NULL');
    }
}
