<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr_branch = ['CABANG CIPINANG','CABANG SURABAYA','CABANG PONTIANAK',
        'CABANG MALANG','CABANG MEDAN','CABANG KEMAYORAN','CABANG YOGYAKARTA'];

        $arr_code = ['01','02','03','04','05','06','07'];

        for($i=0; $i<count($arr_code); $i++)
        {
            $insert = new Branch;
            $insert->code = $arr_code[$i];
            $insert->name = $arr_branch[$i];
            $insert->save();
        }
    }
}
