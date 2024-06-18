<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240617181142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demandeur ADD intitule_poste VARCHAR(30) DEFAULT NULL, ADD localisation_job VARCHAR(15) DEFAULT NULL, ADD type_contrat VARCHAR(10) DEFAULT NULL, ADD teletravail VARCHAR(15) DEFAULT NULL, ADD niv_experience VARCHAR(15) DEFAULT NULL, ADD detail_job LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demandeur DROP intitule_poste, DROP localisation_job, DROP type_contrat, DROP teletravail, DROP niv_experience, DROP detail_job');
    }
}
