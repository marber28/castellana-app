<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new Status();
        $status->name = '1';
        $status->code = '1';
        $status->save();
        $status = new Status();
        $status->name = '2';
        $status->code = '2';
        $status->save();
        $status = new Status();
        $status->name = '3';
        $status->code = '3';
        $status->save();
        $status = new Status();
        $status->name = '4';
        $status->code = '4';
        $status->save();
        $status = new Status();
        $status->name = 'Finalizado';
        $status->code = 'finished';
        $status->save();
    }
}
