<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306152406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transport ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_66AB212EA76ED395 ON transport (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EA76ED395');
        $this->addSql('DROP INDEX IDX_66AB212EA76ED395 ON transport');
        $this->addSql('ALTER TABLE transport DROP user_id');
    }
}
