<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array('admin','skpd','upt','sensus');

    	$users = array(
    		array(
    			'name' => 'Administrator',
            	'username' => 'root',
            	'password' => bcrypt('root')),
    		array(
    			'name' => 'Bidan',
            	'username' => 'bidan',
            	'password' => bcrypt('bidan')),
    		array(
    			'name' => 'UPT',
            	'username' => 'kader',
            	'password' => bcrypt('kader'))
    	);

    	foreach($users as $i => $us)
    	{
        	$data = User::create($us);
        	$data->assignRole($roles[$i]);
        }
    }
}
