<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181024191114 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vehicle_model (id INT AUTO_INCREMENT NOT NULL, manufacturer_id INT DEFAULT NULL, model VARCHAR(255) NOT NULL, INDEX IDX_B53AF235A23B42D (manufacturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (service_id INT AUTO_INCREMENT NOT NULL, vehicle_id INT DEFAULT NULL, service_item_id INT DEFAULT NULL, service_date DATETIME NOT NULL, service_mileage INT NOT NULL, INDEX IDX_E19D9AD2545317D1 (vehicle_id), INDEX IDX_E19D9AD2DDEB00C2 (service_item_id), PRIMARY KEY(service_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_item (id INT AUTO_INCREMENT NOT NULL, item_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_manufacturer (id INT AUTO_INCREMENT NOT NULL, manufacturer VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicles (id INT AUTO_INCREMENT NOT NULL, manufacturer_id INT DEFAULT NULL, model_id INT DEFAULT NULL, year INT NOT NULL, odometer INT NOT NULL, INDEX IDX_1FCE69FAA23B42D (manufacturer_id), INDEX IDX_1FCE69FA7975B7E7 (model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicle_model ADD CONSTRAINT FK_B53AF235A23B42D FOREIGN KEY (manufacturer_id) REFERENCES vehicle_manufacturer (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicles (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2DDEB00C2 FOREIGN KEY (service_item_id) REFERENCES service_item (id)');
        $this->addSql('ALTER TABLE vehicles ADD CONSTRAINT FK_1FCE69FAA23B42D FOREIGN KEY (manufacturer_id) REFERENCES vehicle_manufacturer (id)');
        $this->addSql('ALTER TABLE vehicles ADD CONSTRAINT FK_1FCE69FA7975B7E7 FOREIGN KEY (model_id) REFERENCES vehicle_model (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vehicles DROP FOREIGN KEY FK_1FCE69FA7975B7E7');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2DDEB00C2');
        $this->addSql('ALTER TABLE vehicle_model DROP FOREIGN KEY FK_B53AF235A23B42D');
        $this->addSql('ALTER TABLE vehicles DROP FOREIGN KEY FK_1FCE69FAA23B42D');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2545317D1');
        $this->addSql('DROP TABLE vehicle_model');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_item');
        $this->addSql('DROP TABLE vehicle_manufacturer');
        $this->addSql('DROP TABLE vehicles');
        $this->addSql('DROP TABLE users');
    }
}
