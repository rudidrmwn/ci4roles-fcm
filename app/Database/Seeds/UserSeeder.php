<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
	public function run()
	{
		$user_object = new UserModel();

		$user_object->insertBatch([
			[
				"name" => "Rudi",
				"email" => "rudi@mail.com",
				"phonenumber" => "7899654125",
				"role" => "Maker",
				"password" => password_hash("test1234", PASSWORD_DEFAULT)
			],
			[
				"name" => "Jono",
				"email" => "jono@mail.com",
				"phonenumber" => "8888888888",
				"role" => "Checker",
				"password" => password_hash("test1234", PASSWORD_DEFAULT)
			],
			[
				"name" => "Firman",
				"email" => "firman@mail.com",
				"phonenumber" => "08123456789",
				"role" => "Approval",
				"password" => password_hash("test1234", PASSWORD_DEFAULT)
			]
		]);
	}
}