<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181012130508 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }

    public function postUp(Schema $schema)
    {
        parent::postUp($schema);

        $manufacturers = array('Honda', 'Toyota', 'Chevrolet', 'Ford', 'Subaru', 'BMW', 'Audi', 'Volkswagen', 'Volvo',
            'Dodge', 'Nissan', 'Lexus', 'Jeep');

        for($i=0; $i<count($manufacturers); $i++)
        {
            $this->connection->insert('vehicle_manufacturer', array('manufacturers' => $manufacturers[$i]));
        }
    }
}
