<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181012130339 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vehicle_manufacturer (id INT AUTO_INCREMENT NOT NULL, item_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicles ADD manufacturer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicles ADD CONSTRAINT FK_1FCE69FAA23B42D FOREIGN KEY (manufacturer_id) REFERENCES vehicle_manufacturer (id)');
        $this->addSql('CREATE INDEX IDX_1FCE69FAA23B42D ON vehicles (manufacturer_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vehicles DROP FOREIGN KEY FK_1FCE69FAA23B42D');
        $this->addSql('DROP TABLE vehicle_manufacturer');
        $this->addSql('DROP INDEX IDX_1FCE69FAA23B42D ON vehicles');
        $this->addSql('ALTER TABLE vehicles DROP manufacturer_id');
    }
}
