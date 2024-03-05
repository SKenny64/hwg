<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305141337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81A76ED395');
        $this->addSql('DROP INDEX UNIQ_D4E6F81A76ED395 ON address');
        $this->addSql('ALTER TABLE address DROP user_id');
        $this->addSql('ALTER TABLE coordonnees_organisateur DROP FOREIGN KEY FK_3F326DE4A76ED395');
        $this->addSql('DROP INDEX UNIQ_3F326DE4A76ED395 ON coordonnees_organisateur');
        $this->addSql('ALTER TABLE coordonnees_organisateur DROP user_id');
        $this->addSql('ALTER TABLE coordonnees_utilisateur DROP FOREIGN KEY FK_49CE5930A76ED395');
        $this->addSql('DROP INDEX UNIQ_49CE5930A76ED395 ON coordonnees_utilisateur');
        $this->addSql('ALTER TABLE coordonnees_utilisateur DROP user_id');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA712469DE2');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA712469DE2 ON event');
        $this->addSql('ALTER TABLE event DROP category_id');
        $this->addSql('ALTER TABLE image_event DROP FOREIGN KEY FK_2CEB8E0E71F7E88B');
        $this->addSql('DROP INDEX UNIQ_2CEB8E0E71F7E88B ON image_event');
        $this->addSql('ALTER TABLE image_event DROP event_id');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FA76ED395');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F71F7E88B');
        $this->addSql('DROP INDEX UNIQ_AB55E24FA76ED395 ON participation');
        $this->addSql('DROP INDEX UNIQ_AB55E24F71F7E88B ON participation');
        $this->addSql('ALTER TABLE participation DROP user_id, DROP event_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559909C13F');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('DROP INDEX UNIQ_42C84955A76ED395 ON reservation');
        $this->addSql('DROP INDEX UNIQ_42C849559909C13F ON reservation');
        $this->addSql('ALTER TABLE reservation DROP user_id, DROP transport_id');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E1E4A7B3A');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E71F7E88B');
        $this->addSql('DROP INDEX UNIQ_66AB212E1E4A7B3A ON transport');
        $this->addSql('DROP INDEX UNIQ_66AB212E71F7E88B ON transport');
        $this->addSql('ALTER TABLE transport DROP type_transport_id, DROP event_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D4E6F81A76ED395 ON address (user_id)');
        $this->addSql('ALTER TABLE coordonnees_organisateur ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE coordonnees_organisateur ADD CONSTRAINT FK_3F326DE4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3F326DE4A76ED395 ON coordonnees_organisateur (user_id)');
        $this->addSql('ALTER TABLE coordonnees_utilisateur ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE coordonnees_utilisateur ADD CONSTRAINT FK_49CE5930A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_49CE5930A76ED395 ON coordonnees_utilisateur (user_id)');
        $this->addSql('ALTER TABLE event ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA712469DE2 ON event (category_id)');
        $this->addSql('ALTER TABLE image_event ADD event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image_event ADD CONSTRAINT FK_2CEB8E0E71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2CEB8E0E71F7E88B ON image_event (event_id)');
        $this->addSql('ALTER TABLE participation ADD user_id INT DEFAULT NULL, ADD event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AB55E24FA76ED395 ON participation (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AB55E24F71F7E88B ON participation (event_id)');
        $this->addSql('ALTER TABLE reservation ADD user_id INT DEFAULT NULL, ADD transport_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559909C13F FOREIGN KEY (transport_id) REFERENCES transport (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C84955A76ED395 ON reservation (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C849559909C13F ON reservation (transport_id)');
        $this->addSql('ALTER TABLE transport ADD type_transport_id INT DEFAULT NULL, ADD event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E1E4A7B3A FOREIGN KEY (type_transport_id) REFERENCES type_transport (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_66AB212E1E4A7B3A ON transport (type_transport_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_66AB212E71F7E88B ON transport (event_id)');
    }
}
