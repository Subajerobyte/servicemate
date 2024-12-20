<?php
include('lcheck.php'); 

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=$_SESSION['companyname']?> - Jerobyte - File Manager</title>

  
  <link href="../../1637028036/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"><meta name="theme-color" content="#3d8eb9">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <link href="../../1637028036/css/aarkayen-jrc-2.min.css" rel="stylesheet"> <?php include('../../gstag.php'); ?> <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
  <link href="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../1637028036/vendor/jquery-ui/jquery-ui.css" />
   <link rel="stylesheet"  href="../../1637028036/vendor/select2/css/select2.min.css">
   <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <style>
 .fm-file-box {
    font-size: 25px;
    background: #e9ecef;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.25rem;
}
.font-30 {
    font-size: 30px;
}
.float-end {
    float: right!important;
}
.bg-light-success {
    background-color: rgb(23 160 14 / .11)!important;
}
.bg-light-warning {
    background-color: rgb(255 193 7 / .11)!important;
}
.bg-light-danger {
    background-color: rgb(244 17 39 / .11)!important;
}
.bg-light-primary {
    background-color: rgb(13 110 253 / .11)!important;
}
.ms-2 {
    margin-left: 0.5rem!important;
}
   </style>
</head>

<body id="page-top">

  
  <div id="wrapper">

    
    <?php include('sidebar.php');?>
    

    
    <div id="content-wrapper" class="d-flex flex-column">

      
      <div id="content">

        
          <?php include('navbar.php');?>
          <?php include('officialnavbar.php');?>
         

        
        <div class="container-fluid">

          <!-- Page Heading -->

		  
		   <div class="row">
  <div class="col">
    <h1 class="h4 mb-2 mt-2 text-black-800 text-center"><b>File Manager</b></h1>
  </div>
  <div class="col-auto">
    <a href="imgcomp.php" class="m-2 btn btn-sm btn-primary shadow-sm"> Compress Images</a>
  </div>
</div>
		  
		  <?php
if(isset($_GET['remarks']))
{
?>	
 <div class="alert alert-success shadow"><?=$_GET['remarks']?></div>
<?php
}
 if(isset($_GET['error']))
{
?>	 
  <div class="alert alert-danger shadow"><?=$_GET['error']?></div>
<?php
}
?>
	<?php
	 $sqlselect2 = "SELECT id, expensedoc, edate FROM jrciexpense WHERE edate <= DATE_ADD(NOW(), INTERVAL -30 DAY) ORDER BY id DESC";
        $queryselect2 = mysqli_query($connection, $sqlselect2);
        $rowCountselect2 = mysqli_num_rows($queryselect2);
         
        if(!$queryselect2){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect2 > 0) 
		{ 
	          $rowselects=array();
			while($rowexpen = mysqli_fetch_array($queryselect2)) 
			{
				$rowselects[]=$rowexpen;		
				}
				}
				else
				{
					$rowselects=array();
				}
	   $sqlselect = "SELECT id, expensedoc, edate From jrciexpense where edate BETWEEN NOW() - INTERVAL 30 DAY AND NOW() order by id desc";
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{ 
	          $rowselect=array();
			while($row = mysqli_fetch_array($queryselect)) 
			{
				$rowselect[]=$row;		
				}
				}
				else
				{
					$rowselect=array();
				}
		$sqlselect1 = "SELECT id, DATE(callon) AS callon, diagnosisimg, diagnosissignature From jrccalls where callon BETWEEN NOW() - INTERVAL 30 DAY AND NOW() order by id desc";
        $queryselect1 = mysqli_query($connection, $sqlselect1);
        $rowCountselect1 = mysqli_num_rows($queryselect1);
         
        if(!$queryselect1){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect1 > 0) 
		{
			  $rowcalls=array();
			while($row = mysqli_fetch_array($queryselect1)) 
			{
				$rowcalls[]=$row;
            }				
            }
			else
				{
					$rowcalls=array();
				}
		$sqlselect3 = "SELECT id, DATE(callon) AS callon, diagnosisimg, diagnosissignature FROM jrccalls WHERE callon <= DATE_ADD(NOW(), INTERVAL -30 DAY) ORDER BY id DESC";
        $queryselect3 = mysqli_query($connection, $sqlselect3);
        $rowCountselect3 = mysqli_num_rows($queryselect3);
         
        if(!$queryselect3){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect3 > 0) 
		{
			  $rowcons=array();
			while($row = mysqli_fetch_array($queryselect3)) 
			{
				$rowcons[]=$row;
            }				
            }
			else
				{
					$rowcons=array();
				}	
        $sqlselect5 = "SELECT id, attdate, tickets From jrcengroute where attdate BETWEEN NOW() - INTERVAL 30 DAY AND NOW() order by id desc";
        $queryselect5 = mysqli_query($connection, $sqlselect5);
        $rowCountselect5 = mysqli_num_rows($queryselect5);
         
        if(!$queryselect5){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect5 > 0) 
		{ 
	         $roweng=array();
			while($row = mysqli_fetch_array($queryselect5)) 
		{
			$roweng[]=$row;
			
		}
		}
        else
				{
					$roweng=array();
				}		
        $sqlselect6 = "SELECT id, attdate, tickets FROM jrcengroute WHERE attdate <= DATE_ADD(NOW(), INTERVAL -30 DAY) ORDER BY id DESC";		
        $queryselect6 = mysqli_query($connection, $sqlselect6);
        $rowCountselect6 = mysqli_num_rows($queryselect6);
         
        if(!$queryselect6){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect6 > 0) 
		{ 
	         $rowengs=array();
			while($rowselect6 = mysqli_fetch_array($queryselect6)) 
		{
			$rowengs[]=$rowselect6;
		}
		}
       else
				{
					$rowengs=array();
				}		
       $sqlselect8 = "SELECT id,  DATE(addedon) AS addedon,  imguploads, imgbefuploads From  jrccalldetails where addedon BETWEEN NOW() - INTERVAL 30 DAY AND NOW() order by id desc";   
        $queryselect8 = mysqli_query($connection, $sqlselect8);
        $rowCountselect8 = mysqli_num_rows($queryselect8);
         
        if(!$queryselect8){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect8 > 0) 
		{ 
	        $rowdetails=array();
			while($rowselect8 = mysqli_fetch_array($queryselect8)) 
			{	
          $rowdetails[]=$rowselect8;
		}
		}
       else
		{
			$rowdetails=array();
		}		
		$sqlselect9 = "SELECT id, DATE(addedon) AS addedon, imguploads, imgbefuploads FROM jrccalldetails WHERE addedon <= DATE_ADD(NOW(), INTERVAL -30 DAY) ORDER BY id DESC";   
        $queryselect9 = mysqli_query($connection, $sqlselect9);
        $rowCountselect9 = mysqli_num_rows($queryselect9);
         
        if(!$queryselect9){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect9 > 0) 
		{ 
	        $rowdetail=array();
			while($rowselect9 = mysqli_fetch_array($queryselect9)) 
			{	
          $rowdetail[]=$rowselect9;
		}
		}
        else
		{
			$rowdetail=array();
		}		
   //for folders file count
    $folderPath = "../padhivetram/iexpense/";
	$ext = pathinfo($folderPath, PATHINFO_EXTENSION);
    $countFile = 0;
    $totalFiles = glob($folderPath . "*");
    if ($totalFiles){
         $countFile = count($totalFiles);
    }
	$folderPath1 = "../padhivetram/site/";
	$ext = pathinfo($folderPath1, PATHINFO_EXTENSION);
    $countFile1 = 0;
    $totalFiles1 = glob($folderPath1 . "*");
    if ($totalFiles1){
         $countFile1 = count($totalFiles1);
    }
	$folderPath2 = "../padhivetram/calls/";
	$ext = pathinfo($folderPath2, PATHINFO_EXTENSION);
    $countFile2 = 0;
    $totalFiles2 = glob($folderPath2 . "*");
    if ($totalFiles2){
         $countFile2 = count($totalFiles2);
    }	
	$folderPath3 = "../padhivetram/tickets/";
	$ext = pathinfo($folderPath3, PATHINFO_EXTENSION);
    $countFile3 = 0;
    $totalFiles3 = glob($folderPath3 . "*");
    if ($totalFiles3){
         $countFile3 = count($totalFiles3);
    }	
	
	//for image file count
	$directory = "../padhivetram/iexpense";
	$images = glob($directory . "/*.{jpg,jpeg,gif,img,png}", GLOB_BRACE);
	$count=0;
		if ($images){
			 $count = count($images);
		}
		
	$directory1 = "../padhivetram/site";
	$images1 = glob($directory1 . "/*.{jpg,jpeg,gif,img,png}", GLOB_BRACE);
	$count1=0;
		if ($images1){
			 $count1 = count($images1);
		}
		
	$directory2 = "../padhivetram/calls";
	$images2 = glob($directory2 . "/*.{jpg,jpeg,gif,img,png}", GLOB_BRACE);
	$count2=0;
		if ($images2){
			 $count2 = count($images2);
		}
		
	$directory3 = "../padhivetram/tickets";
	$images3 = glob($directory3 . "/*.{jpg,jpeg,gif,img,png}", GLOB_BRACE);
	$count3=0;
		if ($images3){
			 $count3 = count($images3);
		}
	
   $image=$count+$count1+$count2+$count3;
 
	//for other file count
	$directory16 = "../padhivetram/iexpense";
	$images16 = glob($directory16 . "/*.{csv,xl}", GLOB_BRACE);
	$count16=0;
		if ($images16){
			 $count16 = count($images16);
		}
		
	$directory13 = "../padhivetram/site";
	$images13 = glob($directory13 . "/*.{csv,xl}", GLOB_BRACE);
	$count13=0;
		if ($images13){
			 $count13 = count($images13);
		}
		
	$directory14 = "../padhivetram/calls";
	$images14 = glob($directory14 . "/*.{csv,xl}", GLOB_BRACE);
	$count14=0;
		if ($images14){
			 $count14 = count($images14);
		}
		
	$directory15 = "../padhivetram/tickets";
	$images15 = glob($directory15 . "/*.{csv,xl}", GLOB_BRACE);
	$count15=0;
		if ($images15){
			 $count15 = count($images15);
		}
	
   $image1=$count16+$count13+$count14+$count15;
	
	
	//for document file count
	$folderpath4 = "../padhivetram/iexpense/";
	$totalFiles4 = glob($folderpath4 . "/*.{pdf,doc}", GLOB_BRACE);
	$countFile4=0;
		if ($totalFiles4){
			 $countFile4 = count($totalFiles4);
		}
	$folderPath5 = "../padhivetram/site/";
	$totalFiles5 = glob($folderPath5 . "/*.{pdf,doc}", GLOB_BRACE);
	$countFile5=0;
		if ($totalFiles5){
			 $countFile5 = count($totalFiles5);
		}
	$folderPath6 = "../padhivetram/calls/";
	$totalFiles6 = glob($folderPath6 . "/*.{pdf,doc}", GLOB_BRACE);
	$countFile6=0;
		if ($totalFiles6){
			 $countFile6 = count($totalFiles6);
		}
    $folderPath7 = "../padhivetram/tickets/";
	$totalFiles7 = glob($folderPath7 . "/*.{pdf,doc}", GLOB_BRACE);
	$countFile7=0;
		if ($totalFiles7){
			 $countFile7 = count($totalFiles7);
		}			
	$document=$countFile4+$countFile5+$countFile6+$countFile7;
	
	//for video file count
    $folderpath10 = "../padhivetram/iexpense/";
	$ext = pathinfo($folderpath10, PATHINFO_EXTENSION);
    $countFile10 = 0;
    $totalFiles10 = glob($folderpath10 . "*.video");
    if ($totalFiles10){
         $countFile10 = count($totalFiles10);
    }
	$folderPath11 = "../padhivetram/site/";
	$ext = pathinfo($folderPath11, PATHINFO_EXTENSION);
    $countFile11 = 0;
    $totalFiles11 = glob($folderPath11 . "*.video");
    if ($totalFiles11){
         $countFile11 = count($totalFiles11);
    }
	$folderPath12 = "../padhivetram/calls/";
	$ext = pathinfo($folderPath12, PATHINFO_EXTENSION);
    $countFile12 = 0;
    $totalFiles12 = glob($folderPath12 . "*.video");
    if ($totalFiles12){
         $countFile12 = count($totalFiles12);
    }	
	$folderPath13 = "../padhivetram/tickets/";
	$ext = pathinfo($folderPath13, PATHINFO_EXTENSION);
    $countFile13 = 0;
    $totalFiles13 = glob($folderPath13 . "*.video");
    if ($totalFiles13){
         $countFile13 = count($totalFiles13);
    }	
	$video=$countFile10+$countFile11+$countFile12+$countFile13;
	
	// for folder size
	function folder_size($folder)
{
    $total_size = 0;
    $files = scandir($folder);

    foreach($files as $file)
    {
        if($file == '.' || $file == '..')
        {
            continue;
        }
        $path = $folder . '/' . $file;

        if(is_file($path))
        {
            $total_size += filesize($path);
        }
        else
        {
            $total_size += folder_size($path);
        }
    }

    return $total_size;
}
$folder_path = '../padhivetram/site/';
$folder_size = folder_size($folder_path);
$folder_size . " bytes";
$size=$folder_size;

function file_size($folder)
{
    $total_size = 0;
    $files = scandir($folder);

    foreach($files as $file)
    {
        if($file == '.' || $file == '..')
        {
            continue;
        }
        $path = $folder . '/' . $file;

        if(is_file($path))
        {
            $total_size += filesize($path);
        }
        else
        {
            $total_size += file_size($path);
        }
    }

    return $total_size;
}
$folder_path = '../padhivetram/calls/';
$file_size = file_size($folder_path);
$file_size . " bytes";
$size2=$file_size;

function files_size($folder)
{
    $total_size = 0;
    $files = scandir($folder);

    foreach($files as $file)
    {
        if($file == '.' || $file == '..')
        {
            continue;
        }
        $path = $folder . '/' . $file;

        if(is_file($path))
        {
            $total_size += filesize($path);
        }
        else
        {
            $total_size += files_size($path);
        }
    }

    return $total_size;
}
$folder_path = '../padhivetram/tickets/';
$files_size = files_size($folder_path);
$files_size . " bytes";
$size3=$files_size;

function folders_size($folder)
{
    $total_size = 0;
    $files = scandir($folder);

    foreach($files as $file)
    {
        if($file == '.' || $file == '..')
        {
            continue;
        }
        $path = $folder . '/' . $file;

        if(is_file($path))
        {
            $total_size += filesize($path);
        }
        else
        {
            $total_size += folders_size($path);
        }
    }

    return $total_size;
}

$folder_path = '../padhivetram/iexpense/';
$folders_size = folders_size($folder_path);
$folders_size . " bytes";
$size1=$folders_size;
$totalsize=$size+$size1+$size2+$size3;
 /* if ($totalsize >= (1024 * 1024 * 1024)) {
    $finalTotalGB = round($totalsize / (1024 * 1024 * 1024), 2);
    echo "Final Total Size: $finalTotalGB GB";
} else if ($totalsize >= (1024 * 1024)){
    $finalTotalMB = round($totalsize / (1024 * 1024), 2);
    echo "Final Total Size: $finalTotalMB MB";
}elseif ($totalsize >= 1024) {
	$finalTotalKB = round($totalsize / (1024), 2);
    echo "Final Total Size: $finalTotalKB KB";
}else {
    echo "Final Total Size: $totalsize bytes";
}
 */



//for image file size
$directories = array(
    '../padhivetram/iexpense',
    '../padhivetram/calls',
    '../padhivetram/tickets',
    '../padhivetram/site'
);

$imageExtensions = array('img', 'png', 'jpg', 'jpeg', 'gif');

$finalTotalSize = 0;

foreach ($directories as $directory) {
    if (is_dir($directory)) {
       // echo "Directory: $directory<br>";
        $files = scandir($directory); // Get the list of files in the directory
        $totalSize11 = 0;

        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $filePath = $directory . '/' . $file;
                $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                if (is_file($filePath) && in_array($fileExtension, $imageExtensions)) {
                    $fileSize = filesize($filePath);
                 //   echo "File: $file, Size: $fileSize bytes<br>";
                    $totalSize11 += $fileSize;
                }
            }
        }

       // echo "Total Size: $totalSize bytes<br><br>";
        $finalTotalSize += $totalSize11;
    } else {
       // echo "Invalid directory: $directory<br><br>";
    }
}

 /* if ($finalTotalSize >= (1024 * 1024 * 1024)) {
    $finalTotalSizeGB = round($finalTotalSize / (1024 * 1024 * 1024), 2);
    echo "Final Total Size: $finalTotalSizeGB GB";
} else if ($finalTotalSize >= (1024 * 1024)){
    $finalTotalSizeMB = round($finalTotalSize / (1024 * 1024), 2);
    echo "Final Total Size: $finalTotalSizeMB MB";
}elseif ($finalTotalSize >= 1024) {
	$finalTotalSizeKB = round($finalTotalSize / (1024), 2);
    echo "Final Total Size: $finalTotalSizeKB KB";
}else {
    echo "Final Total Size: $finalTotalSize bytes";
} */
 $progress = min($finalTotalSize / (1024 * 1024 * 1024), 1) * 100;
 
 
 //for document file size
$directories1 = array(
    '../padhivetram/iexpense',
    '../padhivetram/calls',
    '../padhivetram/tickets',
    '../padhivetram/site'
);

$imageExtensions1 = array('pdf','doc');

$finalTotalSize1 = 0;

foreach ($directories1 as $directorys) {
    if (is_dir($directorys)) {
       // echo "Directory: $directory<br>";
        $files1 = scandir($directorys); // Get the list of files in the directory
        $totalSize1 = 0;

        foreach ($files1 as $files) {
            if ($files != '.' && $files != '..') {
                $filePath1 = $directorys . '/' . $files;
                $fileExtension = strtolower(pathinfo($filePath1, PATHINFO_EXTENSION));

                if (is_file($filePath1) && in_array($fileExtension, $imageExtensions1)) {
                    $fileSize1 = filesize($filePath1);
                 //   echo "File: $file, Size: $fileSize bytes<br>";
                    $totalSize1 += $fileSize1;
                }
            }
        }

       // echo "Total Size: $totalSize bytes<br><br>";
        $finalTotalSize1 += $totalSize1;
    } else {
       // echo "Invalid directory: $directory<br><br>";
    }
}

/*  if ($finalTotalSize1 >= (1024 * 1024 * 1024)) {
    $finalTotalSizeGB1 = round($finalTotalSize1 / (1024 * 1024 * 1024), 2);
    echo "Final Total Size: $finalTotalSizeGB1 GB";
} else if ($finalTotalSize1 >= (1024 * 1024)){
    $finalTotalSizeMB1 = round($finalTotalSize1 / (1024 * 1024), 2);
    echo "Final Total Size: $finalTotalSizeMB1 MB";
}elseif ($finalTotalSize1 >= 1024) {
	$finalTotalSizeKB1 = round($finalTotalSize1 / (1024), 2);
    echo "Final Total Size: $finalTotalSizeKB1 KB";
}else {
    echo "Final Total Size: $finalTotalSize1 bytes";
} */
 $progress1 = min($finalTotalSize1 / (1024 * 1024 * 1024), 1) * 100;

 //for video file size
$directories2 = array(
    '../padhivetram/iexpense',
    '../padhivetram/calls',
    '../padhivetram/tickets',
    '../padhivetram/site'
);

$imageExtensions2 = array('video');

$finalTotalSize2 = 0;

foreach ($directories2 as $directorys1) {
    if (is_dir($directorys1)) {
      //  echo "Directory: $directorys1<br>";
        $files2 = scandir($directorys1); // Get the list of files in the directory
        $totalSize2 = 0;

        foreach ($files2 as $files1) {
            if ($files1 != '.' && $files1 != '..') {
                $filePath2 = $directorys1 . '/' . $files1;
                $fileExtension = strtolower(pathinfo($filePath2, PATHINFO_EXTENSION));

                if (is_file($filePath2) && in_array($fileExtension, $imageExtensions2)) {
                    $fileSize2 = filesize($filePath2);
                  //  echo "File: $files1, Size: $fileSize2 bytes<br>";
                    $totalSize2 += $fileSize2;
                }
            }
        }

        //echo "Total Size: $totalSize2 bytes<br><br>";
        $finalTotalSize2 += $totalSize2;
    } else {
       // echo "Invalid directory: $directorys1<br><br>";
    }
}

/*  if ($finalTotalSize2 >= (1024 * 1024 * 1024)) {
    $finalTotalSizeGB2 = round($finalTotalSize2 / (1024 * 1024 * 1024), 2);
    echo "Final Total Size: $finalTotalSizeGB2 GB";
} else if ($finalTotalSize2 >= (1024 * 1024)){
    $finalTotalSizeMB2 = round($finalTotalSize2 / (1024 * 1024), 2);
    echo "Final Total Size: $finalTotalSizeMB2 MB";
}elseif ($finalTotalSize2 >= 1024) {
	$finalTotalSizeKB2 = round($finalTotalSize2 / (1024), 2);
    echo "Final Total Size: $finalTotalSizeKB2 KB";
}else {
    echo "Final Total Size: $finalTotalSize2 bytes";
}  */
  $progress2 = min($finalTotalSize2 / (1024 * 1024 * 1024), 1) * 100;

 
 //for other file size
$directories3 = array(
    '../padhivetram/iexpense',
    '../padhivetram/calls',
    '../padhivetram/tickets',
    '../padhivetram/site'
);

$imageExtensions3 = array('csv','xl');

$finalTotalSize3 = 0;

foreach ($directories3 as $directorys1) {
    if (is_dir($directorys1)) {
      //  echo "Directory: $directorys1<br>";
        $files3 = scandir($directorys1); // Get the list of files in the directory
        $totalSize3 = 0;

        foreach ($files3 as $files1) {
            if ($files1 != '.' && $files1 != '..') {
                $filePath3 = $directorys1 . '/' . $files1;
                $fileExtension = strtolower(pathinfo($filePath3, PATHINFO_EXTENSION));

                if (is_file($filePath3) && in_array($fileExtension, $imageExtensions3)) {
                    $fileSize3 = filesize($filePath3);
                  //  echo "File: $files1, Size: $fileSize3 bytes<br>";
                    $totalSize3 += $fileSize3;
                }
            }
        }

        //echo "Total Size: $totalSize3 bytes<br><br>";
        $finalTotalSize3 += $totalSize3;
    } else {
       // echo "Invalid directory: $directorys1<br><br>";
    }
}

 /*  if ($finalTotalSize3 >= (1024 * 1024 * 1024)) {
    $finalTotalSizeGB3 = round($finalTotalSize3 / (1024 * 1024 * 1024), 2);
    echo "Final Total Size: $finalTotalSizeGB3 GB";
} else if ($finalTotalSize3 >= (1024 * 1024)){
    $finalTotalSizeMB3 = round($finalTotalSize3 / (1024 * 1024), 2);
    echo "Final Total Size: $finalTotalSizeMB3 MB";
}elseif ($finalTotalSize3 >= 1024) {
	$finalTotalSizeKB3 = round($finalTotalSize3 / (1024), 2);
    echo "Final Total Size: $finalTotalSizeKB3 KB";
}else {
    echo "Final Total Size: $finalTotalSize3 bytes";
}  */ 
$progress3 = min($finalTotalSize3 / (1024 * 1024 * 1024), 1) * 100;
 
	?>		
<div class="row">	
<div class="col-12 col-lg-3">		
<div class="card">
<div class="card-body">
<h5 class="mb-0 text-primary font-weight-bold"><?php
 if ($totalsize >= (1024 * 1024 * 1024)) {
    $finalTotalGB = round($totalsize / (1024 * 1024 * 1024), 2);
	echo(round($finalTotalGB,1) . "GB");
} else if ($totalsize >= (1024 * 1024)){
    $finalTotalMB = round($totalsize / (1024 * 1024), 2); 
	echo(round($finalTotalMB,1) . "MB");
}elseif ($totalsize >= 1024) {
	$finalTotalKB = round($totalsize / (1024), 2);
	echo(round($finalTotalKB,1) . "KB");
}else {
	echo(round($totalsize,1) . "bytes");
}
?>
<span class="float-end text-secondary">
<?php
if($_SESSION['imagesize']!='') 
{
	echo $_SESSION['imagesize']. "GB</span>";
}
else
{
	echo "10GB</span>";
}
?>

</h5>
<p class="mb-0 mt-2">
<span class="text-secondary">Used</span>
<span class="float-end text-primary">Upgrade &nbsp;<i class="fa fa-info-circle" data-toggle="tooltip" title="You need to Upgrade your plan. Please Contact Jerobyte Support Team."></i></span>
</p>
<div class="progress mt-3" style="hight:7px;">
<div class="progress-bar bg-primary" role="progressbar" style="width: <?=$progress?>%" aria-valuenow="<?=$progress?>%" aria-valuemin="0" aria-valuemax="100">
</div>
<div class="progress-bar bg-success" role="progressbar" style="width: <?=$progress1?>%" aria-valuenow="<?=$progress1?>%" aria-valuemin="0" aria-valuemax="100">
</div>
<div class="progress-bar bg-danger" role="progressbar" style="width: <?=$progress2?>%" aria-valuenow="<?=$progress2?>%" aria-valuemin="0" aria-valuemax="100">
</div>
<div class="progress-bar bg-warning" role="progressbar" style="width: <?=$progress3?>%" aria-valuenow="<?=$progress3?>%" aria-valuemin="0" aria-valuemax="100">
</div>
</div>
<div class="mt-3">
</div>
<div class="d-flex align-items-center">
<div class="fm-file-box bg-light-primary text-primary">
<i class="bx bx-image"></i>
</div>
<div class="flex grow-1 ms-2">
<h6 class="mb-0">Images</h6>
<p class="mb-0 text-secondary"><?php print_r($image); ?> files</p>
 </div>
<h6 class="text-primary mb-0 ml-auto"><?php 
if ($finalTotalSize >= (1024 * 1024 * 1024)) {
    $finalTotalSizeGB = round($finalTotalSize / (1024 * 1024 * 1024), 2);
	echo(round($finalTotalSizeGB,1) . "GB");
} else if ($finalTotalSize >= (1024 * 1024)){
    $finalTotalSizeMB = round($finalTotalSize / (1024 * 1024), 2);
	echo(round($finalTotalSizeMB,1) . "MB");
}elseif ($finalTotalSize >= 1024) {
	$finalTotalSizeKB = round($finalTotalSize / (1024), 2);
	echo(round($finalTotalSizeKB,1) . "KB");
}else {
	echo(round($finalTotalSize,1) . "bytes");
}
?></h6>
 </div>
 <div class="mt-3">
</div>
 <div class="d-flex align-items-center">
<div class="fm-file-box bg-light-success text-success">
<i class="bx bxs-file-doc">
</i>
</div>
<div class="flex grow-1 ms-2">
<h6 class="mb-0">Documents</h6>
<p class="mb-0 text-secondary"><?php print_r($document); ?> files</p>
 </div>
<h6 class="text-primary mb-0 ml-auto">
<?php
 if ($finalTotalSize1 >= (1024 * 1024 * 1024)) {
    $finalTotalSizeGB1 = round($finalTotalSize1 / (1024 * 1024 * 1024), 2);
	echo(round($finalTotalSizeGB1,1) . "GB");
} else if ($finalTotalSize1 >= (1024 * 1024)){
    $finalTotalSizeMB1 = round($finalTotalSize1 / (1024 * 1024), 2);
	echo(round($finalTotalSizeMB1,1) . "MB");
}elseif ($finalTotalSize1 >= 1024) {
	$finalTotalSizeKB1 = round($finalTotalSize1 / (1024), 2);
	echo(round($finalTotalSizeKB1,1) . "KB");
}else {
	echo(round($finalTotalSize1,1) . "bytes");
}
 ?></h6>
 </div>
 <div class="mt-3">
</div>
<div class="d-flex align-items-center">
<div class="fm-file-box bg-light-danger text-danger">
<i class="bx bx-video"></i>
</div>
<div class="flex grow-1 ms-2">
<h6 class="mb-0">Media Files</h6>
<p class="mb-0 text-secondary"><?php print_r($video); ?> files</p>
 </div>
<h6 class="text-primary mb-0 ml-auto">
<?php
if ($finalTotalSize2 >= (1024 * 1024 * 1024)) {
    $finalTotalSizeGB2 = round($finalTotalSize2 / (1024 * 1024 * 1024), 2);
	echo(round($finalTotalSizeGB2,1) . "GB");
} else if ($finalTotalSize2 >= (1024 * 1024)){
    $finalTotalSizeMB2 = round($finalTotalSize2 / (1024 * 1024), 2);
	echo(round($finalTotalSizeMB2,1) . "MB");
}elseif ($finalTotalSize2 >= 1024) {
	$finalTotalSizeKB2 = round($finalTotalSize2 / (1024), 2);
	echo(round($finalTotalSizeKB2,1) . "KB");
}else {
	echo(round($finalTotalSize2,1) . "bytes");
} 
?>
</h6>
 </div>
 <div class="mt-3">
</div>
<div class="d-flex align-items-center mt-3">
<div class="fm-file-box bg-light-warning text-warning">
<i class="bx bx-image"></i>
</div>
<div class="flex grow-1 ms-2">
<h6 class="mb-0">Other Files</h6>
<p class="mb-0 text-secondary"><?php print_r($image1); ?> files</p>
 </div>
<h6 class="text-primary mb-0 ml-auto">
<?php
if ($finalTotalSize3 >= (1024 * 1024 * 1024)) {
    $finalTotalSizeGB3 = round($finalTotalSize3 / (1024 * 1024 * 1024), 2);
	echo(round($finalTotalSizeGB3,1) . "GB");
} else if ($finalTotalSize3 >= (1024 * 1024)){
    $finalTotalSizeMB3 = round($finalTotalSize3 / (1024 * 1024), 2);
	echo(round($finalTotalSizeMB3,1) . "MB");
}elseif ($finalTotalSize3 >= 1024) {
	$finalTotalSizeKB3 = round($finalTotalSize3 / (1024), 2);
	echo(round($finalTotalSizeKB3,1) . "KB");
}else {
	echo(round($finalTotalSize3,1) . "bytes");
}  
?>
</h6>
 </div>
 </div>
 </div>
 </br>
 <div class="card">
<div class="card-body">
<h5>Folders</h5>
<div class="row mt-3">
<div class="col-12 col-lg-6">
<div class="card shadow-none border radius-15">
<div class="card-body">
<div class="font-30 text-primary">
<i class="fa fa-folder"></i>
</div>
<a href="filesy.php?t=Expense">Expense</a></br>
<small><?php print_r($countFile); ?> file</small>
</div>
</div>
</div>
<div class="col-12 col-lg-6 mb-2">
<div class="card shadow-none border radius-15">
<div class="card-body">
<div class="font-30 text-primary">
<i class="fa fa-folder"></i>
</div>
<a href="filesy.php?t=Calls">Calls</a></br>
<small><?php print_r($countFile3); ?> file</small>
</div>
</div>
</div>
<div class="col-12 col-lg-6 mb-2">
<div class="card shadow-none border radius-15">
<div class="card-body">
<div class="font-30 text-primary">
<i class="fa fa-folder"></i>
</div>
<a href="filesy.php?t=attendance">Tickets</a></br>
<small><?php print_r($countFile2); ?> file</small>
</div>
</div>
</div>
<div class="col-12 col-lg-6 mb-2">
<div class="card shadow-none border radius-15">
<div class="card-body">
<div class="font-30 text-primary">
<i class="fa fa-folder"></i>
</div>
<a href="filesy.php?t=complaint">Complaint</a></br>
<small><?php print_r($countFile1); ?> file</small>
</div>
</div>
</div>
<div class="col-12 col-lg-6 mb-2">
<div class="card shadow-none border radius-15">
<div class="card-body">
<div class="font-30 text-primary">
<i class="fa fa-folder"></i>
</div>
<a href="customize.php">Customize File<i class="fa fa-info-circle" data-toggle="tooltip" title="Click to save files"></i></a>
</div>
</div>
</div>
</div>
 </div>
 </div>
 </div>
 
<div class="col-12 col-lg-9">		
 <div class="card" style="padding:1rem;">
 <h6 class="text-dark">Recent Files</h6>
<div class="card-body">
<div class="row">

 <div class="table-responsive">
                <table class="table table-striped table-hover table-sm mb-0" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>File Name</th>
                      <th>Last Modified</th>
                      <th>View File</th>
					  <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
				   <?php
				  $count=1;
				  foreach ($rowselect as $row)
				  {
				   if($row['expensedoc']!='')
						{
				   ?> 
    				  <tr>
                      <td><?=$count?></td>
					  <?php
						$ext = pathinfo($row['expensedoc'], PATHINFO_EXTENSION);
						if ($ext=="pdf") {
						   
						?>
						<td class="text-success"><i class="bx bxs-file-doc"></i>&nbsp;Expense</td>
						<?php
						}
						else if ($ext=="img" || $ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ) {
						   
						?>
						<td class="text-primary"><i class="bx bx-image"></i>&nbsp;Expense</td>
						<?php
						}
						else if ($ext=="video") {
						   
						?>
						<td class="text-danger"><i class="bx bx-video"></i>&nbsp;Expense</td>
						<?php
						}
						else{
							?>
						<td class="text-warning"><i class="bx bx-image"></i>&nbsp;Expense</td>
							<?php
						}
						?>
                      <td><?=$row['edate']?></td>
                      <td><a href="<?php echo $row['expensedoc']?>" target="_blank" >View</a></td>
					  <td><a href="filedelete.php?id=<?=$row['id']?>&img=<?=$row['expensedoc']?>&t=Expense" onclick="return checkconfirm()" class="text-danger">Delete</a></td>
                    </tr>
					<?php
					$count++;
				  }
				  }
				   ?>
				   <?php
				  foreach ($rowcalls as $row)
				  {
				   if($row['diagnosisimg']!='')
						{
				   ?>
				    <tr>
                      <td><?=$count?></td>
					  <?php
						$ext = pathinfo($row['diagnosisimg'], PATHINFO_EXTENSION);
						if ($ext=="pdf") {
						   
						?>
						<td class="text-success"><i class="bx bxs-file-doc"></i>&nbsp;Calls</td>
						<?php
						}
						else if ($ext=="img" || $ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ) {
						   
						?>
						<td class="text-primary"><i class="bx bx-image"></i>&nbsp;Calls</td>
						<?php
						}
						else if ($ext=="video") {
						   
						?>
						<td class="text-danger"><i class="bx bx-video"></i>&nbsp;Calls</td>
						<?php
						}
						else{
							?>
						<td class="text-warning"><i class="bx bx-image"></i>&nbsp;Calls</td>
							<?php
						}
						?>
                      <td><?=$row['callon']?></td>
					  <td><a href="<?php echo $row['diagnosisimg']?>" target="_blank" >View</a></td>
					  <td><a href="filedelete.php?id=<?=$row['id']?>&img=<?=$row['diagnosisimg']?>&t=calls" onclick="return checkconfirm()" class="text-danger">Delete</a></td>
                    </tr>
					<?php
					$count++;
				  }
				  }
				   ?>
				   <?php
				  foreach ($rowcalls as $row)
				  {
				   if($row['diagnosissignature']!='')
						{
				   ?> 
				      <tr>
                      <td><?=$count?></td>
					  <?php
						$ext = pathinfo($row['diagnosissignature'], PATHINFO_EXTENSION);
						if ($ext=="pdf") {
						   
						?>
						<td class="text-success"><i class="bx bxs-file-doc"></i>&nbsp;Calls</td>
						<?php
						}
						else if ($ext=="img" || $ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ) {
						   
						?>
						<td class="text-primary"><i class="bx bx-image"></i>&nbsp;Calls</td>
						<?php
						}
						else if ($ext=="video") {
						   
						?>
						<td class="text-danger"><i class="bx bx-video"></i>&nbsp;Calls</td>
						<?php
						}
						else{
							?>
						<td class="text-warning"><i class="bx bx-image"></i>&nbsp;Calls</td>
							<?php
						}
						?>
                      <td><?=$row['callon']?></td>
					  <td><a href="<?php echo $row['diagnosissignature']?>" target="_blank" >View</a></td>
					   <td><a href="filedelete.php?id=<?=$row['id']?>&img=<?=$row['diagnosissignature']?>&t=calls1" onclick="return checkconfirm()" class="text-danger">Delete</a></td>
                    </tr>
					<?php
					$count++;
				  }
				  }
				   ?>
				   <?php
				  foreach ($roweng as $row)
				  {
				   if($row['tickets']!='')
						{
				   ?>
				     <tr>
                      <td><?=$count?></td>
					  <?php
						$ext = pathinfo($row['tickets'], PATHINFO_EXTENSION);
						if ($ext=="pdf") {
						   
						?>
						<td class="text-success"><i class="bx bxs-file-doc"></i>&nbsp;Tickets</td>
						<?php
						}
						else if ($ext=="img" || $ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ) {
						   
						?>
						<td class="text-primary"><i class="bx bx-image"></i>&nbsp;Tickets</td>
						<?php
						}
						else if ($ext=="video") {
						   
						?>
						<td class="text-danger"><i class="bx bx-video"></i>&nbsp;Tickets</td>
						<?php
						}
						else{
							?>
						<td class="text-warning"><i class="bx bx-image"></i>&nbsp;Tickets</td>
							<?php
						}
						?>
                      <td><?=$row['attdate']?></td>
					  <td><a href="<?php echo $row['tickets']?>" target="_blank" >View</a></td>
					 <td><a href="filedelete.php?id=<?=$row['id']?>&img=<?=$row['tickets']?>&t=attendance" onclick="return checkconfirm()" class="text-danger">Delete</a></td>
                    </tr>
					<?php
					$count++;
				  }
				  }
				   ?>
				   <?php
				  foreach ($rowdetails as $row)
				  {
				   if(isset($row['imguploads'])!='')
						{
				   ?>
				     <tr>
                      <td><?=$count?></td>
					  <?php
						$ext = pathinfo($row['imguploads'], PATHINFO_EXTENSION);
						if ($ext=="pdf") {
						   
						?>
						<td class="text-success"><i class="bx bxs-file-doc"></i>&nbsp;Complaint</td>
						<?php
						}
						else if ($ext=="img" || $ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ) {
						   
						?>
						<td class="text-primary"><i class="bx bx-image"></i>&nbsp;Complaint</td>
						<?php
						}
						else if ($ext=="video") {
						   
						?>
						<td class="text-danger"><i class="bx bx-video"></i>&nbsp;Complaint</td>
						<?php
						}
						else{
							?>
						<td class="text-warning"><i class="bx bx-image"></i>&nbsp;Complaint</td>
							<?php
						}
						?>
                      <td><?=$row['addedon']?></td>
					  <td><a href="<?php echo $row['imguploads']?>" target="_blank" >View</a></td>
					 <td><a href="filedelete.php?id=<?=$row['id']?>&img=<?=$row['imguploads']?>&t=complaint" onclick="return checkconfirm()" class="text-danger">Delete</a></td>
                    </tr>
					<?php
					$count++;
				  }
				  }
				   ?>
				    <?php
				  foreach ($rowdetails as $row)
				  {
				   if(isset($row['imgbefuploads'])!='')
						{
				   ?>
				     <tr>
                      <td><?=$count?></td>
					  <?php
						$ext = pathinfo($row['imgbefuploads'], PATHINFO_EXTENSION);
						if ($ext=="pdf") {
						   
						?>
						<td class="text-success"><i class="bx bxs-file-doc"></i>&nbsp;Complaint</td>
						<?php
						}
						else if ($ext=="img" || $ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ) {
						   
						?>
						<td class="text-primary"><i class="bx bx-image"></i>&nbsp;Complaint</td>
						<?php
						}
						else if ($ext=="video") {
						   
						?>
						<td class="text-danger"><i class="bx bx-video"></i>&nbsp;Complaint</td>
						<?php
						}
						else{
							?>
						<td class="text-warning"><i class="bx bx-image"></i>&nbsp;Complaint</td>
							<?php
						}
						?>
                      <td><?=$row['addedon']?></td>
					  <td><a href="<?php echo $row['imgbefuploads']?>" target="_blank" >View</a></td>
					  <td><a href="filedelete.php?id=<?=$row['id']?>&img=<?=$row['imgbefuploads']?>&t=complaint1" onclick="return checkconfirm()" class="text-danger">Delete</a></td>
                    </tr>
					<?php
					$count++;
				  }
				  }
				   ?>
					
                  </tbody>
                </table>
              </div>
              </div>
 </div>
 </div>
 </br>

 <div class="card" style="padding:1rem;">
 <h6 class="text-dark">Old Files</h6>
<div class="card-body">
<div class="row">
 <div class="table-responsive">
                <table class="table table-striped table-hover table-sm mb-0" id="dataTable1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>File Name</th>
                      <th>Last Modified</th>
					  <th>View File</th>
					  <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $count=1;
				  foreach($rowselects as $row)
				  {
					    if($row['expensedoc']!='')
						{
				   ?>  
				      <tr>
                      <td><?=$count?></td>
					  <?php
						$ext = pathinfo($row['expensedoc'], PATHINFO_EXTENSION);
						if ($ext=="pdf") {
						   
						?>
						<td class="text-success"><i class="bx bxs-file-doc"></i>&nbsp;Expense</td>
						<?php
						}
						else if ($ext=="img" || $ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ) {
						   
						?>
						<td class="text-primary"><i class="bx bx-image"></i>&nbsp;Expense</td>
						<?php
						}
						else if ($ext=="video") {
						   
						?>
						<td class="text-danger"><i class="bx bx-video"></i>&nbsp;Expense</td>
						<?php
						}
						else{
							?>
						<td class="text-warning"><i class="bx bx-image"></i>&nbsp;Expense</td>
							<?php
						}
						
						?>
                      <td><?=$row['edate']?></td>
					  <td><a href="<?php echo $row['expensedoc']?>" target="_blank" >View</a></td>
					  <td><a href="filedelete.php?id=<?=$row['id']?>&img=<?=$row['expensedoc']?>&t=Expense" onclick="return checkconfirm()" class="text-danger">Delete</a></td>
                    </tr>
					<?php
					$count++;
				  }
				  }
				   ?>
				    <?php
				  foreach ($rowcons as $rowcon)
				  {
				   if($rowcon['diagnosisimg']!='')
						{
				   ?>
				   <tr>
                      <td><?=$count?></td>
					  <?php
						$ext = pathinfo($rowcon['diagnosisimg'], PATHINFO_EXTENSION);
						if ($ext=="pdf") {
						   
						?>
						<td class="text-success"><i class="bx bxs-file-doc"></i>&nbsp;Calls</td>
						<?php
						}
						else if ($ext=="img" || $ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ) {
						   
						?>
						<td class="text-primary"><i class="bx bx-image"></i>&nbsp;Calls</td>
						<?php
						}
						else if ($ext=="video") {
						   
						?>
						<td class="text-danger"><i class="bx bx-video"></i>&nbsp;Calls</td>
						<?php
						}
						else{
							?>
						<td class="text-warning"><i class="bx bx-image"></i>&nbsp;Calls</td>
							<?php
						}
						?>
                      <td><?=$rowcon['callon']?></td>
					  <td><a href="<?php echo $rowcon['diagnosisimg']?>" target="_blank" >View</a></td>
					 <td><a href="filedelete.php?id=<?=$rowcon['id']?>&img=<?=$rowcon['diagnosisimg']?>&t=calls" onclick="return checkconfirm()" class="text-danger">Delete</a></td>
                    </tr>
					<?php
					$count++;
				  }
				  }
				   ?>
				   <?php
				  foreach ($rowcons as $rowcon)
				  {
				   if($rowcon['diagnosissignature']!='')
						{
				   ?>
				   <tr>
                      <td><?=$count?></td>
					  <?php
						$ext = pathinfo($rowcon['diagnosissignature'], PATHINFO_EXTENSION);
						if ($ext=="pdf") {
						   
						?>
						<td class="text-success"><i class="bx bxs-file-doc"></i>&nbsp;Calls</td>
						<?php
						}
						else if ($ext=="img" || $ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ) {
						   
						?>
						<td class="text-primary"><i class="bx bx-image"></i>&nbsp;Calls</td>
						<?php
						}
						else if ($ext=="video") {
						   
						?>
						<td class="text-danger"><i class="bx bx-video"></i>&nbsp;Calls</td>
						<?php
						}
						else{
							?>
						<td class="text-warning"><i class="bx bx-image"></i>&nbsp;Calls</td>
							<?php
						}
						?>
                      <td><?=$rowcon['callon']?></td>
					   <td><a href="<?php echo $row['diagnosissignature']?>" target="_blank" >View</a></td>
					  <td><a href="filedelete.php?id=<?=$rowcon['id']?>&img=<?=$rowcon['diagnosissignature']?>&t=calls1" onclick="return checkconfirm()" class="text-danger">Delete</a></td>
                    </tr>
					<?php
					$count++;
				  }
				  }
				   ?>
				   <?php
				  foreach ($rowengs as $row)
				  {
				   if($row['tickets']!='')
						{
				   ?>
				   <tr>
                      <td><?=$count?></td>
					  <?php
						$ext = pathinfo($row['tickets'], PATHINFO_EXTENSION);
						if ($ext=="pdf") {
						   
						?>
						<td class="text-success"><i class="bx bxs-file-doc"></i>&nbsp;Tickets</td>
						<?php
						}
						else if ($ext=="img" || $ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ) {
						   
						?>
						<td class="text-primary"><i class="bx bx-image"></i>&nbsp;Tickets</td>
						<?php
						}
						else if ($ext=="video") {
						   
						?>
						<td class="text-danger"><i class="bx bx-video"></i>&nbsp;Tickets</td>
						<?php
						}
						else{
							?>
						<td class="text-warning"><i class="bx bx-image"></i>&nbsp;Tickets</td>
							<?php
						}
						?>
                      <td><?=$row['attdate']?></td>
					  <td><a href="<?php echo $row['tickets']?>" target="_blank" >View</a></td>
					  <td><a href="filedelete.php?id=<?=$row['id']?>&img=<?=$row['tickets']?>&t=attendance" onclick="return checkconfirm()" class="text-danger">Delete</a></td>
                    </tr>
					<?php
					$count++;
				  }
				  }
				   ?>
				   <?php
				  foreach ($rowdetail as $row)
				  {
				   if(isset($row['imguploads'])!='')
						{
				   ?>
				     <tr>
                      <td><?=$count?></td>
					  <?php
						$ext = pathinfo($row['imguploads'], PATHINFO_EXTENSION);
						if ($ext=="pdf") {
						   
						?>
						<td class="text-success"><i class="bx bxs-file-doc"></i>&nbsp;Complaint</td>
						<?php
						}
						else if ($ext=="img" || $ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ) {
						   
						?>
						<td class="text-primary"><i class="bx bx-image"></i>&nbsp;Complaint</td>
						<?php
						}
						else if ($ext=="video") {
						   
						?>
						<td class="text-danger"><i class="bx bx-video"></i>&nbsp;Complaint</td>
						<?php
						}
						else{
							?>
						<td class="text-warning"><i class="bx bx-image"></i>&nbsp;Complaint</td>
							<?php
						}
						?>
                      <td><?=$row['addedon']?></td>
					  <td><a href="<?php echo $row['imguploads']?>" target="_blank" >View</a></td>
					 <td><a href="filedelete.php?id=<?=$row['id']?>&img=<?=$row['imguploads']?>&t=complaint" onclick="return checkconfirm()" class="text-danger">Delete</a></td>
                    </tr>
					<?php
					$count++;
				  }
				  }
				   ?>
				    <?php
				  foreach ($rowdetail as $row)
				  {
				   if(isset($row['imgbefuploads'])!='')
						{
				   ?>
				     <tr>
                      <td><?=$count?></td>
					  <?php
						$ext = pathinfo($row['imgbefuploads'], PATHINFO_EXTENSION);
						if ($ext=="pdf") {
						   
						?>
						<td class="text-success"><i class="bx bxs-file-doc"></i>&nbsp;Complaint</td>
						<?php
						}
						else if ($ext=="img" || $ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ) {
						   
						?>
						<td class="text-primary"><i class="bx bx-image"></i>&nbsp;Complaint</td>
						<?php
						}
						else if ($ext=="video") {
						   
						?>
						<td class="text-danger"><i class="bx bx-video"></i>&nbsp;Complaint</td>
						<?php
						}
						else{
							?>
						<td class="text-warning"><i class="bx bx-image"></i>&nbsp;Complaint</td>
							<?php
						}
						?>
                      <td><?=$row['addedon']?></td>
					  <td><a href="<?php echo $row['imgbefuploads']?>" target="_blank" >View</a></td>
					 <td><a href="filedelete.php?id=<?=$row['id']?>&img=<?=$row['imgbefuploads']?>&t=complaint1" onclick="return checkconfirm()" class="text-danger">Delete</a></td>
                    </tr>
					<?php
					$count++;
				  }
				  }
				   ?>
					
                  </tbody>
                </table>
              </div>
              </div>
 </div>
 </div>
 </div>

          </div>

      
         

      </div>
       

       
      <?php include('footer.php'); ?>
       

    </div>
     

  </div>
   

   
  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a><a class="scroll-to-bottom rounded" href="#page-bottom"><i class="fas fa-angle-down"></i></a><a class="scroll-to-back rounded" href="javascript:history.go(-1)"><i class="fas fa-angle-left"></i></a>

   
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  
  <script src="../../1637028036/vendor/jquery/jquery.min.js"></script>
  <script src="../../1637028036/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  
  <script src="../../1637028036/vendor/jquery-easing/jquery.easing.min.js"></script>

  
  <script src="../../1637028036/js/aarkayen-jrc-2.min.js"></script><script src="notification.js"></script>

  <!-- Page level plugins -->
  <script src="../../1637028036/vendor/chart.js/Chart.min.js"></script> <script src="../../1637028036/vendor/chart.js/chartjs-plugin-labels.js"></script>


  <!-- Page level plugins -->
  <script src="../../1637028036/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../../1637028036/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../../1637028036/js/datatables.js"></script>
  <script src="../../1637028036/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="../../1637028036/vendor/select2/js/select2.min.js" type="text/javascript"></script>  
 <script>
function checkconfirm()
{
	 var a=confirm("Are You Sure! You Need To Delete This Image?");
	if(a==true)
	{
	 return true;
	}
	else
	{
	 return false;
	} 
}
function checkcomp()
{
	 var a=confirm("Are you sure you need to compress all the images?");
	if(a==true)
	{
	 return true;
	}
	else
	{
	 return false;
	} 
}
</script>
<?php include('additionaljs.php');   ?>
</body>
</html>
