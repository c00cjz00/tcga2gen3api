<?php
// conda activate g3po4
// export GEN3_URL=https://ng3.libthomas.org/
$string = file_get_contents("clinical.json");
$json_data = json_decode($string, true);
// 變魔法！
#$iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($json_data));
// 當成一維陣列迭代！
#foreach ($iterator as $element) {
#    echo "$element" . PHP_EOL;
#}

//print_r($json_data);
$i=0;
foreach ($json_data as $key => $arr) {
 $i++;

 if (isset($arr["demographic"])){
  $data["type"]="demographic";
  $data["cases"]["id"]=$arr["case_id"];
  $data["ethnicity"]=$arr["demographic"]["ethnicity"];
  $data["gender"]=$arr["demographic"]["gender"];
  $data["race"]=$arr["demographic"]["race"];
  $data["submitter_id"]=$arr["demographic"]["submitter_id"];
  $data["id"]=$arr["demographic"]["demographic_id"];
  $data["year_of_birth"]=$arr["demographic"]["year_of_birth"];
  $data["year_of_death"]=$arr["demographic"]["year_of_death"];
  $json = "[".json_encode ( $data )."]" ; 
  //echo $json."\n";
  $prgfile_hx = tempnam("/tmp", "json_"); $fp = fopen($prgfile_hx, "w"); fwrite($fp, $json); fclose($fp);
  $cmd="php 03-gdc_metadata_add.php $prgfile_hx";
  echo $cmd."\n";
  exec($cmd);
  unlink($prgfile_hx);
  unset($data);
  //exit();
 }
}
// $json = json_encode ( $data ) ; 
// $prgfile_hx = tempnam("/tmp", "json_"); $fp = fopen($prgfile_hx, "w"); fwrite($fp, $json); fclose($fp);
// $cmd="php 03-gdc_metadata_add.php $prgfile_hx";
// echo $cmd;
// exec($cmd);
// unlink($prgfile_hx);
// $data="";

/*
{
  "type": "demographic",
  "cases": [
    {
      "submitter_id": "TCGA-CC-A8HU"
    }
  ],
  "ethnicity": "not hispanic or latino",
  "gender": "female",
  "race": "white",
  "submitter_id": "TCGA-AN-A0AK_demographic",
  "year_of_birth": 1934
}


  "demographic": {
   x "race": "white",
   x "gender": "female",
   x "ethnicity": "not hispanic or latino",
   x "vital_status": "Alive",
    "age_at_index": 76,
  x  "submitter_id": "TCGA-AN-A0AK_demographic",
    "days_to_birth": -27977,
    "created_datetime": null,
  x  "year_of_birth": 1934,
    "demographic_id": "cc0845ee-2d00-5e3c-acbe-4f7511040fcc",
    "updated_datetime": "2019-07-31T21:24:25.918821-05:00",
    "state": "released",
   x "year_of_death": null
  }
*/


