// app/database/seeds/UserTableSeeder.php

<?php

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        User::create(
            array(
                'name'     => 'Chris Sevilleja',
                'username' => 'sevilayha',
                'email'    => 'chris@scotch.io',
                'password' => Hash::make('awesome'),
            )
        );
    }
}
