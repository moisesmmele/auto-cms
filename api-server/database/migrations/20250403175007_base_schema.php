<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class BaseSchema extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        //TODO: Replace change() method with up() method and add table and column verification before applying changes

        $users = $this->table('users');
        $users->addColumn('first_name', 'string', ['length' => 255])
            ->addColumn('last_name', 'string', ['length' => 255])
            ->addColumn('email', 'string', ['length' => 255])
            ->addColumn('password', 'string', ['length' => 255])
            ->addColumn('token', 'string', ['length' => 255])
            ->create();

        $makes = $this->table('makes');
        $makes->addColumn('label', 'string', ['null' => false])
            ->create();

        $chassis = $this->table('chassis_types');
        $chassis->addColumn('label', 'string', ['null' => false])
            ->create();

        $fuel = $this->table('fuel_types');
        $fuel->addColumn('label', 'string', ['null' => false])
            ->create();

        $gearbox = $this->table('gearbox_types');
        $gearbox->addColumn('label', 'string', ['null' => false])
            ->create();

        $color = $this->table('colors');
        $color->addColumn('label', 'string', ['null' => false])
            ->create();

        $accessory = $this->table('accessories');
        $accessory->addColumn('label', 'string', ['null' => false])
            ->create();

        $image = $this->table('images');
        $image->addColumn('name', 'string', ['null' => true])
            ->addColumn('extension', 'string', ['null' => false, 'limit' => 32])
            ->addColumn('width', 'integer', ['null' => false])
            ->addColumn('height', 'integer', ['null' => false])
            ->create();

        $vehicle = $this->table('vehicles');
        $vehicle->addColumn('vin', 'string', ['null' => false, 'limit' => 17])
            ->addColumn('license_plate', 'string', ['null' => false, 'limit' => 7])
            ->addColumn('make_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('chassis_type_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('fuel_type_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('gearbox_type_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('color_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('model', 'string', ['null' => false, 'limit' => 150])
            ->addColumn('model_year', 'integer', ['null' => false])
            ->addColumn('mileage', 'integer', ['null' => false])
            ->addColumn('description', 'text', ['null' => false, 'limit' => 65535])
            ->addForeignKey('make_id', 'makes', 'id')
            ->addForeignKey('chassis_type_id', 'chassis_types', 'id')
            ->addForeignKey('fuel_type_id', 'fuel_types', 'id')
            ->addForeignKey('gearbox_type_id', 'gearbox_types', 'id')
            ->addForeignKey('color_id', 'colors', 'id')
            ->create();

        $listing = $this->table('listings');
        $listing->addColumn('vehicle_id',  'integer', ['null' => false, 'signed' => false])
            ->addColumn('price', 'float', ['null' => false])
            ->addForeignKey('vehicle_id', 'vehicles', 'id')
            ->create();

        $lead = $this->table('leads');
        $lead->addColumn('listing_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('name', 'string', ['null' => false, 'limit' => 100])
            ->addColumn('email', 'string', ['null' => false, 'limit' => 100])
            ->addColumn('phone', 'string', ['null' => false, 'limit' => 100])
            ->addColumn('message', 'text', ['null' => false, 'limit' => 65535])
            ->addForeignKey('listing_id', 'listings', 'id')
            ->create();

        //pivot tables
        $images_vehicles = $this->table('images_vehicles');
        $images_vehicles->addColumn('vehicle_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('image_id', 'integer', ['null' => false, 'signed' => false])
            ->addForeignKey('image_id', 'images', 'id')
            ->addForeignKey('vehicle_id', 'vehicles', 'id')
            ->create();

        $accessories_vehicles = $this->table('accessories_vehicles');
        $accessories_vehicles->addColumn('vehicle_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('accessory_id', 'integer', ['null' => false, 'signed' => false])
            ->addForeignKey('vehicle_id', 'vehicles', 'id')
            ->addForeignKey('accessory_id', 'accessories', 'id')
            ->create();
    }
}
