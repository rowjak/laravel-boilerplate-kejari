<?php

use Illuminate\Database\Seeder;

class RowjakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User;
        $user->username = 'admin';
        $user->name = 'Administrator';
        $user->email = 'admin@batangkab.go.id';
        $user->password = \Hash::make('kejari()()');
        $user->save();
        $this->command->info('User Berhasil Dibuat');
    }
}
