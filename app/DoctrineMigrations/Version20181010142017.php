<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181010142017 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2B051928F');
        $this->addSql('DROP INDEX IDX_E19D9AD2B051928F ON service');
        $this->addSql('ALTER TABLE service CHANGE service_itemid service_item_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2DDEB00C2 FOREIGN KEY (service_item_id) REFERENCES service_item (id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD2DDEB00C2 ON service (service_item_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2DDEB00C2');
        $this->addSql('DROP INDEX IDX_E19D9AD2DDEB00C2 ON service');
        $this->addSql('ALTER TABLE service CHANGE service_item_id service_itemID INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2B051928F FOREIGN KEY (service_itemID) REFERENCES service_item (id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD2B051928F ON service (service_itemID)');
    }
}
