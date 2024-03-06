<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306103035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, nom_evenement VARCHAR(150) NOT NULL, date_evenement DATE NOT NULL, heure_evenement TIME NOT NULL, descriptif LONGTEXT NOT NULL, ville_evenement VARCHAR(100) NOT NULL, code_postal_evenement VARCHAR(50) NOT NULL, nom_lieu VARCHAR(150) NOT NULL, capacite_total INT DEFAULT NULL, duree VARCHAR(10) DEFAULT NULL, tarif_evenement NUMERIC(6, 2) DEFAULT NULL, status_evenement VARCHAR(50) NOT NULL, date_creation DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
