<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        $this->call(InstitucionTableSeeder::class);
        $this->call(AvisoTableSeeder::class);


        $this->command->info('SocialBook app seeds finished.');


        Model::reguard();
    }
}

