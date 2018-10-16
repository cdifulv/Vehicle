<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181012162854 extends AbstractMigration
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

        $manufacturerID = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13);

        $models = array('Civic', 'Camry', 'Cruise', 'Explorer', 'Outback', '5 Series', 'A6', 'Jetta', 'XC90',
            'Charger', 'Altima', 'LS', 'Wrangler');

        for($i=0; $i<count($models); $i++)
        {
            $this->connection->insert('vehicle_model', array('model' => $models[$i], 'manufacturer_id' => $manufacturerID[$i]));
        }
    }
}
