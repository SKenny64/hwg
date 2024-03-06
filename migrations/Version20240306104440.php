<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306104440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mode_paiement_transport (id INT AUTO_INCREMENT NOT NULL, libelle_paiement VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, tarif_personne NUMERIC(10, 2) DEFAULT NULL, descriptif LONGTEXT DEFAULT NULL, info_contact LONGTEXT DEFAULT NULL, date_depart DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', date_creation DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', lieu_depart LONGTEXT DEFAULT NULL, nb_place SMALLINT DEFAULT NULL, info_paiement LONGTEXT DEFAULT NULL, statut_transport VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_transport (id INT AUTO_INCREMENT NOT NULL, libelle_transport VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE mode_paiement_transport');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE type_transport');
    }
}
