<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306154013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coordonnees_organisateur ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE coordonnees_organisateur ADD CONSTRAINT FK_3F326DE4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3F326DE4A76ED395 ON coordonnees_organisateur (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coordonnees_organisateur DROP FOREIGN KEY FK_3F326DE4A76ED395');
        $this->addSql('DROP INDEX IDX_3F326DE4A76ED395 ON coordonnees_organisateur');
        $this->addSql('ALTER TABLE coordonnees_organisateur DROP user_id');
    }
}
