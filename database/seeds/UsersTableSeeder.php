<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    private $users = [
        [
            'name'=> 'Евгений',
            'patronymic'=>'Владимирович',
            'surname'=>'Мирошниченко',
            'email'=>'CodeLookBook@gmail.com',
            'password'=>'969348',
            'role'=>'admin',
        ],
        [
            'name'=> 'Aндрей',
            'patronymic'=>'Васильевич',
            'surname'=>'Мирошниченко',
            'email'=>'admin@gmail.com',
            'password'=>'-1-1-1-1-1-1-',
            'role'=>'admin'
        ],
        [
            'name' => 'Тест',
            'patronymic' => 'Тестович',
            'surname' => 'Тестенко',
            'email' => 'test@gmail.com',
            'password' => '111111',
            'role' => 'editor'
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->users as $userData){


            $user = new User();
            $user->name = $userData['name'];
            $user->patronymic = $userData['patronymic'];
            $user->surname =  $userData['surname'];
            $user->email = $userData['email'];
            $user->password = bcrypt($userData['password']);

            $role = Role::where('name', $userData['role'])->firstOrFail();

            $user->role()->associate($role);
            $user->save();
        }
    }
}
