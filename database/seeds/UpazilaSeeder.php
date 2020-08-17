<?php

use Illuminate\Database\Seeder;
use App\Upazila;

class UpazilaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_path = public_path('data/upazilas/upazilas.csv');
        $excel = new \App\Helper\ExcelReader($file_path);
        $upazilaData = [];
        if($excel->fileExists()) {
            $upazilas = $excel->getData();
            foreach ($upazilas as $upazila) {
                $upazilaData[] = [
                    'district_id' => $upazila['district_id'],
                    'upazilaName' => $upazila['name'],
                    'banglaName' => $upazila['bangla_name'],
                ];
            }
        }
        $upazilaInsert = Upazila::insert($upazilaData);
    }
}
