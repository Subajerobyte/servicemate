<?php
$arrFiles = array();
$arrFiles2 = array();

$fileList = glob('../61646d696e6c6f67696e/*.php');
foreach($fileList as $entry){
    if(is_file($entry))
	{
		if(!is_dir($entry)) 
		{
			$arrFiles[] = $entry;
			$arrFiles2[]=str_replace("../61646d696e6c6f67696e/","", str_replace(".php","", $entry));
		}
    }   
}

foreach($arrFiles as $entry)
{
	if(!is_dir($entry)) 
	{
	$str=file_get_contents($entry);	
	$str1=explode("<?php",$str);
	//echo "First String='".$str1[0]."'<br>";
	unset($str1[0]);
	foreach($arrFiles2 as $en2)
	{
		$str1=str_replace($en2.'.php',base64_encode($en2).'.php', $str1);
	}
	$str=implode("<?php",$str1);
	$encode=base64_encode($str);
	$entry2=str_replace("../61646d696e6c6f67696e/","", $entry);
	$entry2=str_replace(".php","", $entry2);
	
	$encfile=base64_encode($entry2);
	echo $encfile.'<br>';
	$entry1="../61646d696e6c6f67696e1/".$encfile.".php";
	file_put_contents($entry1,"<?php eval(base64_decode(\"".$encode."\"));?>");
	echo $entry1.'<br>';
	}
}
