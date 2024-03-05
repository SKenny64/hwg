<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305092038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coordonnees_organisateur (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, raison_sociale VARCHAR(100) NOT NULL, site_web VARCHAR(100) DEFAULT NULL, telephone VARCHAR(20) DEFAULT NULL, UNIQUE INDEX UNIQ_3F326DE4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coordonnees_organisateur ADD CONSTRAINT FK_3F326DE4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coordonnees_organisateur DROP FOREIGN KEY FK_3F326DE4A76ED395');
        $this->addSql('DROP TABLE coordonnees_organisateur');
    }
}
