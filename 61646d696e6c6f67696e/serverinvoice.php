<?php
				  $sqlselect = "SELECT * From jrcxl group by invoiceno, invoicedate order by consigneename asc";
				  
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
			?>
                    <tr>
                      <td><?=$count?></td>
                      <td><?=$rowselect['invoiceno']?></td>
					  <td><?=($rowselect['invoicedate']!='')?(date('d/m/Y',strtotime($rowselect['invoicedate']))):''?></td>
					  <td><?=$rowselect['maincategory']?></td>
					  <td><?=$rowselect['subcategory']?></td>
					  <?php
					  if($rowselect['consigneename']!="")
					  {
						?>
                      <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>"><?=$rowselect['consigneename']?></a></td>
					  <?php
					  }
					  else
					  {
					  ?>
					  <td><a href="consigneeview.php?id=<?=$rowselect['consigneeid']?>">View</a></td>
					  <?php
					  }
					  ?>
					  <td><?=$rowselect['department']?></td>
					  <td><?=$rowselect['address1']?> <?=$rowselect['address2']?> <?=$rowselect['area']?> <?=$rowselect['district']?> <?=$rowselect['pincode']?></td>
					  <td><?=$rowselect['contact']?> <?=$rowselect['phone']?> <?=$rowselect['mobile']?> <?=$rowselect['email']?></td>
					  <td><a href="invoiceedit.php?id=<?=$rowselect['id']?>">Edit</a></td>
                    </tr>
					<?php
					$count++;
			}
		}
			?>
<?php
// DB table to use
$table = 'tbl_employee';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'name', 'dt' => 0 ),
    array( 'db' => 'age',  'dt' => 1 ),
    array( 'db' => 'salary',   'dt' => 2 )
   
   
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => 'test',
    'db'   => 'phpsamples',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../1637028036/vendor/DataTables/server-side/scripts/ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);












