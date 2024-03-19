<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240312111423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, adresse LONGTEXT DEFAULT NULL, complement LONGTEXT DEFAULT NULL, ville VARCHAR(150) DEFAULT NULL, code_postal VARCHAR(20) DEFAULT NULL, INDEX IDX_C35F0816A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle_categorie VARCHAR(50) NOT NULL, couleur VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coordonnees_organisateur (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, raison_sociale VARCHAR(100) DEFAULT NULL, site_web VARCHAR(100) DEFAULT NULL, telephone VARCHAR(20) DEFAULT NULL, INDEX IDX_3F326DE4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coordonnees_utilisateur (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, civilite VARCHAR(10) DEFAULT NULL, prenom VARCHAR(50) DEFAULT NULL, nom VARCHAR(120) DEFAULT NULL, telephone VARCHAR(20) DEFAULT NULL, INDEX IDX_49CE5930A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, user_id INT DEFAULT NULL, nom_evenement VARCHAR(150) NOT NULL, date_evenement DATE NOT NULL, heure_evenement TIME NOT NULL, descriptif LONGTEXT NOT NULL, ville_evenement VARCHAR(100) NOT NULL, code_postal_evenement VARCHAR(50) NOT NULL, nom_lieu VARCHAR(150) NOT NULL, capacite_total INT DEFAULT NULL, duree VARCHAR(10) DEFAULT NULL, tarif_evenement NUMERIC(6, 2) DEFAULT NULL, status_evenement VARCHAR(50) NOT NULL, date_creation DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B26681EBCF5E72D (categorie_id), INDEX IDX_B26681EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_evenement (id INT AUTO_INCREMENT NOT NULL, evenement_id INT DEFAULT NULL, couverture TINYINT(1) DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D3A4B34AFD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, evenement_id INT DEFAULT NULL, user_id INT DEFAULT NULL, date_participation DATE DEFAULT NULL, INDEX IDX_AB55E24FFD02F13 (evenement_id), INDEX IDX_AB55E24FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, transport_id INT DEFAULT NULL, date_reservation DATE DEFAULT NULL, INDEX IDX_42C84955A76ED395 (user_id), INDEX IDX_42C849559909C13F (transport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, type_transport_id INT DEFAULT NULL, evenement_id INT DEFAULT NULL, user_id INT DEFAULT NULL, tarif_personne NUMERIC(10, 2) DEFAULT NULL, descriptif LONGTEXT DEFAULT NULL, info_contact LONGTEXT DEFAULT NULL, date_depart DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', date_creation DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', lieu_depart LONGTEXT DEFAULT NULL, nb_place SMALLINT DEFAULT NULL, info_paiement LONGTEXT DEFAULT NULL, statut_transport VARCHAR(50) DEFAULT NULL, INDEX IDX_66AB212E1E4A7B3A (type_transport_id), INDEX IDX_66AB212EFD02F13 (evenement_id), INDEX IDX_66AB212EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_transport (id INT AUTO_INCREMENT NOT NULL, libelle_transport VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, date_creation_user DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE coordonnees_organisateur ADD CONSTRAINT FK_3F326DE4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE coordonnees_utilisateur ADD CONSTRAINT FK_49CE5930A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE image_evenement ADD CONSTRAINT FK_D3A4B34AFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559909C13F FOREIGN KEY (transport_id) REFERENCES transport (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E1E4A7B3A FOREIGN KEY (type_transport_id) REFERENCES type_transport (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A76ED395');
        $this->addSql('ALTER TABLE coordonnees_organisateur DROP FOREIGN KEY FK_3F326DE4A76ED395');
        $this->addSql('ALTER TABLE coordonnees_utilisateur DROP FOREIGN KEY FK_49CE5930A76ED395');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EBCF5E72D');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EA76ED395');
        $this->addSql('ALTER TABLE image_evenement DROP FOREIGN KEY FK_D3A4B34AFD02F13');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FFD02F13');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FA76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559909C13F');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E1E4A7B3A');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EFD02F13');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EA76ED395');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE coordonnees_organisateur');
        $this->addSql('DROP TABLE coordonnees_utilisateur');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE image_evenement');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE type_transport');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
