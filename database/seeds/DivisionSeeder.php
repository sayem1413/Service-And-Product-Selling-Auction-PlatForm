<?php

use Illuminate\Database\Seeder;
use App\Division;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_path = public_path('data/divisions/divisions.csv');

        $excel = new \App\Helper\ExcelReader($file_path);

        if($excel->fileExists()) {

            $data = $excel->getData();

            $this->insertDistricts($data);
        }

    }


    protected function insertDistricts($data) {

        foreach ($data as $aDistrict) {

            $currentDivision = ucwords($aDistrict["division"]);
            $currentDistrict = ucwords($aDistrict["district"]);
            $currentDistrict = str_replace("District","",$currentDistrict);

            if($currentDivision!="") {

                $divisionQuery = Division::where("name",$currentDivision);

                $divisionId = $divisionQuery->exists() ?  $divisionQuery->first()->id
                    :   $this->insertDivision($currentDivision)->id;

                if(!District::where('name', $currentDistrict)->exists()) {
                    District::create([
                        "name" => $currentDistrict,
                        "division_id" => $divisionId
                    ]);
                }
            }
        }
    }

    protected function insertDivision($divisionName) {
        return Division::create(["name" => $divisionName]);
    }

    protected function extractDistricts($data) {
        $districtArray = array();

        foreach ($data as $aDistrict) {

            $currentDivision = ucwords($aDistrict["division"]);
            $currentDistrict = ucwords($aDistrict["district"]);
            $currentDistrict = str_replace("District","",$currentDistrict);

            if($currentDivision!="") {
                if(!isset($districtArray[$currentDivision]))
                    $districtArray[$currentDivision] = array();

                array_push($districtArray[$currentDivision],$currentDistrict);
            }
        }

        return $districtArray;
    }
}