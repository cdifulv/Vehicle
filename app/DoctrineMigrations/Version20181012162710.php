<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181012162710 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vehicle_model (id INT AUTO_INCREMENT NOT NULL, manufacturer_id INT DEFAULT NULL, manufacturer VARCHAR(255) NOT NULL, INDEX IDX_B53AF235A23B42D (manufacturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicle_model ADD CONSTRAINT FK_B53AF235A23B42D FOREIGN KEY (manufacturer_id) REFERENCES vehicle_manufacturer (id)');
        $this->addSql('ALTER TABLE vehicles ADD model_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicles ADD CONSTRAINT FK_1FCE69FA7975B7E7 FOREIGN KEY (model_id) REFERENCES vehicle_model (id)');
        $this->addSql('CREATE INDEX IDX_1FCE69FA7975B7E7 ON vehicles (model_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vehicles DROP FOREIGN KEY FK_1FCE69FA7975B7E7');
        $this->addSql('DROP TABLE vehicle_model');
        $this->addSql('DROP INDEX IDX_1FCE69FA7975B7E7 ON vehicles');
        $this->addSql('ALTER TABLE vehicles DROP model_id');
    }
}
