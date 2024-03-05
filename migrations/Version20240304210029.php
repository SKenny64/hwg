<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240304210029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transport ADD type_transport_id INT DEFAULT NULL, ADD event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E1E4A7B3A FOREIGN KEY (type_transport_id) REFERENCES type_transport (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_66AB212E1E4A7B3A ON transport (type_transport_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_66AB212E71F7E88B ON transport (event_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E1E4A7B3A');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E71F7E88B');
        $this->addSql('DROP INDEX UNIQ_66AB212E1E4A7B3A ON transport');
        $this->addSql('DROP INDEX UNIQ_66AB212E71F7E88B ON transport');
        $this->addSql('ALTER TABLE transport DROP type_transport_id, DROP event_id');
    }
}
