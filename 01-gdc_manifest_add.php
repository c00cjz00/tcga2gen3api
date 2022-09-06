<?php
// conda activate g3po4
// export GEN3_URL=https://ng3.libthomas.org/
$manifest="gdc_manifest.txt";
$arr=file($manifest);
foreach ($arr as $key => $value) {
 //id      filename        md5     size    state	
 $tmpArr=explode("\t",trim($value));
 $did=$tmpArr[0]; 
 if (strlen($did)>10){ 
  $file_name=$tmpArr[1]; 
  $md5=$tmpArr[2]; 
  $size=$tmpArr[3]; 
  $bucket="tcgademo";
  $authz="/programs/jnkns/projects/jenkins";
  $uploader="summerhill001@gmail.com";
  #python 01-gdc_manifest_add.py 95de72fe73e512e7863065dd3d620252 462747644 cc4e713b-f86a-44b6-b714-458611b268de nchcbucket7 TCGA-A8-A07G-01Z-00-DX1.37E8A762-8141-4BE6-935A-B3DCB712BB4A.svs /programs/jnkns/projects/jenkins summerhill001@gmail.com
  $cmd="python 01-gdc_manifest_add.py $md5 $size $did $bucket $file_name $authz $uploader";
  echo $cmd."\n";
  exec($cmd);
 }
}
