<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305091658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coordonnees_utilisateur ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE coordonnees_utilisateur ADD CONSTRAINT FK_49CE5930A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_49CE5930A76ED395 ON coordonnees_utilisateur (user_id)');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coordonnees_utilisateur DROP FOREIGN KEY FK_49CE5930A76ED395');
        $this->addSql('DROP INDEX UNIQ_49CE5930A76ED395 ON coordonnees_utilisateur');
        $this->addSql('ALTER TABLE coordonnees_utilisateur DROP user_id');
        $this->addSql('ALTER TABLE user DROP is_verified');
    }
}
