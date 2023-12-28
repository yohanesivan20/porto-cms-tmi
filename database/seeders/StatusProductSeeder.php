<?php

namespace Database\Seeders;

use App\Models\StatusMasterProduct;
use Illuminate\Database\Seeder;

class StatusProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr_status = ['SARAN','ARSIP','WAJIB'];
        $arr_order = ['1','1','1'];
        $arr_sell = ['1','1','0'];
        $arr_archive = ['0','1','1'];
        $arr_flag = ['1','1','0'];

        for($i=0; $i<count($arr_status); $i++) {
            $insert_status = new StatusMasterProduct;
            $insert_status->status = $arr_status[$i];
            $insert_status->can_order = $arr_order[$i];
            $insert_status->can_sell = $arr_sell[$i];
            $insert_status->can_archive = $arr_flag[$i];
            $insert_status->save();
        }
    }
}
