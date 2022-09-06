<?php
// $string = file_get_contents("slide.json");
// $json_data = json_decode($string, true);
// foreach ($json_data as $key => $arr) {
 // foreach ($arr as $key1 => $arr1) {
  // $submitter_id=$arr1["submitter_id"];
  // $$submitter_id=1;
 // }
// }

// conda activate g3po4
// export GEN3_URL=https://ng3.libthomas.org/
$string = file_get_contents("biospecimen.json");
$json_data = json_decode($string, true);
// 變魔法！
#$iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($json_data));
// 當成一維陣列迭代！
#foreach ($iterator as $element) {
#    echo "$element" . PHP_EOL;
#}

//print_r($json_data);
foreach ($json_data as $key => $arr) {
 if (isset($arr["samples"])){
  foreach ($arr["samples"] as $key1 => $arr1) {
   if (isset($arr1["portions"])){
    foreach ($arr1["portions"] as $key2 => $arr2) {
	 if (isset($arr2["slides"])){
      foreach ($arr2["slides"] as $key3 => $arr3) {
       if (!isset($arr3["number_proliferating_cells"])) $arr3["number_proliferating_cells"]=null; 
       if (!isset($arr3["percent_tumor_cells"])) $arr3["percent_tumor_cells"]=null; 
       if (!isset($arr3["percent_stromal_cells"])) $arr3["percent_stromal_cells"]=null; 
       if (!isset($arr3["percent_eosinophil_infiltration"])) $arr3["percent_eosinophil_infiltration"]=null; 
       if (!isset($arr3["percent_inflam_infiltration"])) $arr3["percent_inflam_infiltration"]=null; 
       if (!isset($arr3["percent_neutrophil_infiltration"])) $arr3["percent_neutrophil_infiltration"]=null; 
       if (!isset($arr3["percent_lymphocyte_infiltration"])) $arr3["percent_lymphocyte_infiltration"]=null; 
       if (!isset($arr3["percent_granulocyte_infiltration"])) $arr3["percent_granulocyte_infiltration"]=null; 
       if (!isset($arr3["percent_necrosis"])) $arr3["percent_necrosis"]=null; 
       if (!isset($arr3["percent_normal_cells"])) $arr3["percent_normal_cells"]=null; 
       if (!isset($arr3["percent_monocyte_infiltration"])) $arr3["percent_monocyte_infiltration"]=null; 
       if (!isset($arr3["percent_tumor_nuclei"])) $arr3["percent_tumor_nuclei"]=null; 
       if (!isset($arr3["updated_datetime"])) $arr3["updated_datetime"]=null; 
       if (!isset($arr3["section_location"])) $arr3["section_location"]=null; 		  
	  
       $data["type"]="slide";
	   $data["samples"]["id"]=$arr1["sample_id"];
	   //$data["samples"]["submitter_id"]=$arr1["submitter_id"];
       $data["number_proliferating_cells"]=$arr3["number_proliferating_cells"];
       $data["percent_tumor_cells"]=$arr3["percent_tumor_cells"];
       $data["percent_stromal_cells"]=$arr3["percent_stromal_cells"];
       $data["percent_eosinophil_infiltration"]=$arr3["percent_eosinophil_infiltration"];
       $data["percent_inflam_infiltration"]=$arr3["percent_inflam_infiltration"];
       $data["percent_neutrophil_infiltration"]=$arr3["percent_neutrophil_infiltration"];
       $data["percent_lymphocyte_infiltration"]=$arr3["percent_lymphocyte_infiltration"];
       $data["percent_granulocyte_infiltration"]=$arr3["percent_granulocyte_infiltration"];
       $data["percent_necrosis"]=$arr3["percent_necrosis"];
       $data["percent_normal_cells"]=$arr3["percent_normal_cells"];
       $data["percent_monocyte_infiltration"]=$arr3["percent_monocyte_infiltration"];
       $data["percent_tumor_nuclei"]=$arr3["percent_tumor_nuclei"];
       $data["run_datetime"]=$arr3["updated_datetime"];
       $data["submitter_id"]=$arr3["submitter_id"];
       $data["id"]=$arr3["slide_id"];
       $data["section_location"]=$arr3["section_location"];

	   $submitter_id_tmp=$arr3["submitter_id"];
	   if (!isset($$submitter_id_tmp)) {
	    $json = "[".json_encode ( $data )."]" ; 
	    echo $json."\n";
	    $prgfile_hx = tempnam("/tmp", "json_"); $fp = fopen($prgfile_hx, "w"); fwrite($fp, $json); fclose($fp);
	    $cmd="php 03-gdc_metadata_add.php $prgfile_hx";
	    echo $cmd."\n";
	    echo shell_exec($cmd);
	    unlink($prgfile_hx);	   
	   }
	   unset($data);
	  }
	 }
    }
   }
  }
 }

}



// 描述
/*
{
  "type": "slide",
  "percent_stromal_cells": "percent_stromal_cells",
  "samples": [
    {
      "submitter_id": "123"
    }
  ],
  "submitter_id": "1234567",
  "section_location": "TOP",
  "percent_tumor_cells": "percent_tumor_cells",
  "number_proliferating_cells": "number_proliferating_c",
  "percent_eosinophil_infiltration": "percent_eosinophil_infi",
  "percent_inflam_infiltration": "percent_inflam_infi",
  "percent_neutrophil_infiltration": "rcent_neutrophil_in",
  "percent_lymphocyte_infiltration": "rcent_lymphocyte_in",
  "percent_granulocyte_infiltration": "ercent_granulocyte_infi",
  "percent_necrosis": "rcent_necro",
  "percent_normal_cells": "ercent_normal_ce",
  "percent_monocyte_infiltration": "ent_monocyte_infil",
  "percent_tumor_nuclei": "rcent_tumor_n",
  "run_datetime": "updated_datetime"
}



             "percent_stromal_cells": 19.0,
              "submitter_id": "TCGA-BH-A0BD-01A-01-BSA",
              "section_location": "BOTTOM",
              "percent_tumor_cells": 75.0,
              "number_proliferating_cells": null,
              "slide_id": "660ee152-efee-472b-95d1-1e5723ca1f64",
              "percent_eosinophil_infiltration": null,
              "created_datetime": null,
              "percent_inflam_infiltration": null,
              "percent_neutrophil_infiltration": 0.0,
              "percent_lymphocyte_infiltration": 7.0,
              "percent_granulocyte_infiltration": null,
              "updated_datetime": "2018-09-06T13:49:20.245333-05:00",
              "percent_necrosis": 1.0,
              "percent_normal_cells": 5.0,
              "percent_monocyte_infiltration": 0.0,
              "state": "released",
              "percent_tumor_nuclei": 85.0
            },



*/


