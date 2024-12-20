<?php
include('lcheck.php');
$sqllayoutservice=mysqli_query($connection, "select * from jrclayoutservice");
$infolayoutservice=mysqli_fetch_array($sqllayoutservice);
if(isset($_POST['id']))
{
	$callid=mysqli_real_escape_string($connection,$_POST['id']);
	echo '<div class="container">
            <h4>Call ID: '.$callid.'</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-timeline7">';
				
				  $sqlselect = "SELECT sourceid, modifiedon, changeon, callon, callhandlingid, callhandlingname, coordinatorid, coordinatorname, engineerid, engineername, compstatus, problemobserved, actiontaken, reportedproblem, modifyreason From jrccallshistory where calltid='".$callid."' order by id asc";
				 
        $queryselect = mysqli_query($connection, $sqlselect);
        $rowCountselect = mysqli_num_rows($queryselect);
         
        if(!$queryselect){
           die("SQL query failed: " . mysqli_error($connection));
        }
         
        if($rowCountselect > 0) 
		{
			$count=1;
			while($rowselect = mysqli_fetch_array($queryselect)) 
			{
				$sqlxl = "SELECT stocksubcategory, consigneeid, componentname From jrcxl where tdelete='0' and  id='".$rowselect['sourceid']."' order by id asc";
				$queryxl = mysqli_query($connection, $sqlxl);
				$rowCountxl = mysqli_num_rows($queryxl);
				 
				if(!$queryxl){
				   die("SQL query failed: " . mysqli_error($connection));
				}
				 
				if($rowCountxl > 0) 
				{
					$rowxl = mysqli_fetch_array($queryxl);
					$consigneeid=mysqli_real_escape_string($connection,$rowxl['consigneeid']);
				 
		
		echo '<div class="timeline">
                            <div class="timeline-icon"><i class="fa fa-phone"></i></div>
                            <span class="year">';
							if($rowselect['modifiedon']!='')
							{
								echo date('d/m/Y h:i:s a', strtotime($rowselect['modifiedon']));
							}
							else if($rowselect['changeon']!='')
							{
								echo date('d/m/Y h:i:s a', strtotime($rowselect['changeon']));
							}
							else
							{
								echo date('d/m/Y h:i:s a', strtotime($rowselect['callon']));
							}
							echo '</span>
                            <div class="timeline-content">
                                <h5 class="title">';
								echo $rowxl['stocksubcategory'].'-'.$rowxl['componentname'];
								echo '</h5>
                                <p class="description">';
								?>
								<b>C/H:</b> <a href="callhandlingview.php?id=<?=$rowselect['callhandlingid']?>"><?=$rowselect['callhandlingname']?></a><br>
					  <b>C/O:</b> <a href="coordinatorview.php?id=<?=$rowselect['coordinatorid']?>"><?=$rowselect['coordinatorname']?></a><br>
					  <b>E:</b> <a href="mapengineerview.php?id=<?=$rowselect['engineerid']?>&attdate=<?=date('Y-m-d')?>"><?=$rowselect['engineername']?></a><br>
					  
					  <b>Status:</b> <?php
					 if($rowselect['compstatus']=='2')
					  {
						?>
						<span class="text-success">Completed</span><br>
						<b>P/R:</b> <?=$rowselect['reportedproblem']?><br>
					  <b>P/O:</b> <?=$rowselect['problemobserved']?><br>
					  <b>A/T:</b> <?=$rowselect['actiontaken']?>
					  <b>Report:</b><a href="<?=($infolayoutservice['reportformat']=='1')?'complaintprint.php':'complaintprint1.php'?>?id=<?=$callid?>" target="_blank">View Report</a>
						<?php
						
					  }
					  else if($rowselect['compstatus']=='1')
					  {
						?>
						<span class="text-danger">Pending</span><br>
						<b>P/R:</b> <?=$rowselect['reportedproblem']?><br>
					  <b>P/O:</b> <?=$rowselect['problemobserved']?><br>
					  <b>A/T:</b> <?=$rowselect['actiontaken']?>
					  <b>Report:</b><a href="<?=($infolayoutservice['reportformat']=='1')?'complaintprint.php':'complaintprint1.php'?>?id=<?=$callid?>&s=p" target="_blank">View Report</a>
						<?php
						
					  } 
					  else if($rowselect['compstatus']=='3')
					  {
						?>
						<span class="text-info">Cancelled</span><br>
						<b>P/R:</b> <?=$rowselect['reportedproblem']?><br>
					  <b>P/O:</b> <?=$rowselect['problemobserved']?><br>
					  <b>A/T:</b> <?=$rowselect['actiontaken']?>
					   <b>Report:</b><a href="<?=($infolayoutservice['reportformat']=='1')?'complaintprint.php':'complaintprint1.php'?>?id=<?=$callid?>" target="_blank">View Report</a>
						<?php
						
					  }
					  else
					 {
						?>
						<span class="text-warning">Open</span><br>
						<b>P/R:</b> <?=$rowselect['reportedproblem']?>
						<?php
						
					  }
					  ?>
								<?php
								if($rowselect['modifyreason']!='')
								{
									?>
									<br><span>(RE-ASSIGN: <?=$rowselect['modifyreason']?>)</span>
									<?php
								}
                                    echo '</p>
                            </div>
                        </div>';
					$count++;
				}
				
			}
		}
					
					
					
                        
                    echo '</div>
                </div>
            </div>
        </div>';
}
?>