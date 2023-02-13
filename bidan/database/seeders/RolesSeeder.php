<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
        array('slug' => 'admin','name' => 'Administrator'),
        array('slug' => 'bidan','name' => 'Bidan'),
        array('slug' => 'kader','name' => 'Kader')
      );

      foreach($roles as $role)
      {
          Role::create($role);
        }
    }
}
