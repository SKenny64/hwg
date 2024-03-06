<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306124050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_evenement ADD evenement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image_evenement ADD CONSTRAINT FK_D3A4B34AFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_D3A4B34AFD02F13 ON image_evenement (evenement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_evenement DROP FOREIGN KEY FK_D3A4B34AFD02F13');
        $this->addSql('DROP INDEX IDX_D3A4B34AFD02F13 ON image_evenement');
        $this->addSql('ALTER TABLE image_evenement DROP evenement_id');
    }
}
