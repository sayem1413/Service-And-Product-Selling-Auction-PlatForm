<?php

use Illuminate\Database\Seeder;
use App\District;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_path = public_path('data/districts/districts.csv');
        $excel = new \App\Helper\ExcelReader($file_path);
        $districtData = [];
        if($excel->fileExists()) {
            $districts = $excel->getData();
            foreach ($districts as $district) {
                $divisionData[] = [
                    'division_id' => $district['division_id'],
                    'districtName' => $district['name'],
                    'banglaName' => $district['bangla_name'],
                    // 'districtLatitude' => $district['lat'],
                    // 'districtLongitude' => $district['lon'],
                    // 'website' => $district['url'],
                ];
            }
        }
        $districtInsert = District::insert($divisionData);
    }
}
