<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * @var array Default roles list
     */
    private $roles=[
        'member',
        'editor',
        'admin',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $name){
            $role = new Role();
            $role->name = $name;
            $role->save();
        }
    }
}

