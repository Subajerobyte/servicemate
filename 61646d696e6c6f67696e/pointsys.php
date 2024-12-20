<?php
class dbConfig {
    protected $serverName;
    protected $userName;
    protected $password;
    protected $dbName;
    function __construct() {
        $this -> serverName = "localhost";
        $this -> userName = "root";
        $this -> password = "";
        $this -> dbName = "jero_jrc";
    }
}
class Points extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $empTable = 'jrcpoints';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 		
			$database = new dbConfig();            
            $this -> hostName = $database -> serverName;
            $this -> userName = $database -> userName;
            $this -> password = $database ->password;
			$this -> dbName = $database -> dbName;			
            $conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}   	
	public function PointsList(){		
		$sqlQuery = "SELECT * FROM ".$this->empTable." ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'where(ID LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR PNAME LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR PCB_Coating LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR INSTALLATION_ALONE LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR DELIVERY_ALONE LIKE "%'.$_POST["search"]["value"].'%") ';	
			
		}
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY ID ASC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		
		$sqlQuery1 = "SELECT * FROM ".$this->empTable." ";
		$result1 = mysqli_query($this->dbConnect, $sqlQuery1);
		$numRows = mysqli_num_rows($result1);
		
		$PointsData = array();	
		while( $Points = mysqli_fetch_assoc($result) ) {		
			$empRows = array();			
		$empRows[] = $Points['ID'];
$empRows[] = $Points['PNAME'];
$empRows[] = $Points['DELI_INSTA'];
$empRows[] = $Points['DELIVERY_ALONE'];
$empRows[] = $Points['INSTALLATION_ALONE'];
$empRows[] = $Points['Lug_Work'];
$empRows[] = $Points['PCB_Coating'];
$empRows[] = $Points['Testing'];
$empRows[] = $Points['Packing'];
$empRows[] = $Points['External_Rectfi'];
$empRows[] = $Points['PCB_Power_Components'];
$empRows[] = $Points['Cntrl_PCB'];
$empRows[] = $Points['Charger_PCB'];
$empRows[] = $Points['Inverter_PCB'];
$empRows[] = $Points['others'];
$empRows[] = $Points['HUPS_WITH_TUBULAR_BATTERY'];
$empRows[] = $Points['ONLINE_UPS_WITH_SMF_BATTERY'];
$empRows[] = $Points['ONLINE_UPS_WITH_TUBULAR_BATTERY'];
$empRows[] = $Points['OFFGRID_SOLAR_PCU'];
$empRows[] = $Points['ONGRID_SOLAR_PCU'];
$empRows[] = $Points['UPS_ALONE_SMF'];
$empRows[] = $Points['BATTERY_ALONE_SMF'];
$empRows[] = $Points['UPS_BATTERY_SMF'];
$empRows[] = $Points['UPS_ALONE_TUBE'];
$empRows[] = $Points['BATTERY_ALONE_TUBE'];
$empRows[] = $Points['UPS_BATTERY_TUBE'];
$empRows[] = $Points['PRODUTIVITY_DAY'];
$empRows[] = $Points['POINTS_DAY'];
$empRows[] = $Points['POINTS_PRODUCT'];	
$empRows[] = $Points['DC_SIGN_WORK'];				
			$empRows[] = '<button type="button" PNAME="update" ID="'.$Points["ID"].'" class="btn btn-warning btn-xs update">Modify</button>';
			$empRows[] = '<button type="button" PNAME="delete" ID="'.$Points["ID"].'" class="btn btn-danger btn-xs delete" >Delete</button>';
			$PointsData[] = $empRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$PointsData
		);
		echo json_encode($output);
	}
	public function getPoints(){
		if($_POST["empId"]) {
			$sqlQuery = "
				SELECT * FROM ".$this->empTable." 
				WHERE ID = '".$_POST["empId"]."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}
	}
	public function updatePoints(){
		if($_POST['empId']) {	
			$updateQuery = "UPDATE ".$this->empTable." 
			SET PNAME = '".$_POST["PNAME"]."', DELI_INSTA = '".$_POST["DELI_INSTA"]."', DELIVERY_ALONE = '".$_POST["DELIVERY_ALONE"]."', INSTALLATION_ALONE = '".$_POST["INSTALLATION_ALONE"]."' , Lug_Work = '".$_POST["Lug_Work"]."' , PCB_Coating = '".$_POST["PCB_Coating"]."' , Testing = '".$_POST["Testing"]."' , Packing = '".$_POST["Packing"]."' , External_Rectfi = '".$_POST["External_Rectfi"]."' , PCB_Power_Components = '".$_POST["PCB_Power_Components"]."' , Cntrl_PCB = '".$_POST["Cntrl_PCB"]."' , Charger_PCB = '".$_POST["Charger_PCB"]."' , Inverter_PCB = '".$_POST["Inverter_PCB"]."' , others = '".$_POST["others"]."' , HUPS_WITH_TUBULAR_BATTERY = '".$_POST["HUPS_WITH_TUBULAR_BATTERY"]."' , ONLINE_UPS_WITH_SMF_BATTERY = '".$_POST["ONLINE_UPS_WITH_SMF_BATTERY"]."' , ONLINE_UPS_WITH_TUBULAR_BATTERY = '".$_POST["ONLINE_UPS_WITH_TUBULAR_BATTERY"]."' , OFFGRID_SOLAR_PCU = '".$_POST["OFFGRID_SOLAR_PCU"]."' , ONGRID_SOLAR_PCU = '".$_POST["ONGRID_SOLAR_PCU"]."' , UPS_ALONE_SMF = '".$_POST["UPS_ALONE_SMF"]."' , BATTERY_ALONE_SMF = '".$_POST["BATTERY_ALONE_SMF"]."' , UPS_BATTERY_SMF = '".$_POST["UPS_BATTERY_SMF"]."' , UPS_ALONE_TUBE = '".$_POST["UPS_ALONE_TUBE"]."' , BATTERY_ALONE_TUBE = '".$_POST["BATTERY_ALONE_TUBE"]."' , UPS_BATTERY_TUBE = '".$_POST["UPS_BATTERY_TUBE"]."' , PRODUTIVITY_DAY = '".$_POST["PRODUTIVITY_DAY"]."' , POINTS_DAY = '".$_POST["POINTS_DAY"]."' , POINTS_PRODUCT = '".$_POST["POINTS_PRODUCT"]."', DC_SIGN_WORK = '".$_POST["DC_SIGN_WORK"]."' WHERE ID ='".$_POST["empId"]."'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}
	public function addPoints(){
		$insertQuery = "INSERT INTO ".$this->empTable." (PNAME, DELI_INSTA, DELIVERY_ALONE, INSTALLATION_ALONE, Lug_Work, PCB_Coating, Testing, Packing, External_Rectfi, PCB_Power_Components, Cntrl_PCB, Charger_PCB, Inverter_PCB, others, HUPS_WITH_TUBULAR_BATTERY, ONLINE_UPS_WITH_SMF_BATTERY, ONLINE_UPS_WITH_TUBULAR_BATTERY, OFFGRID_SOLAR_PCU, ONGRID_SOLAR_PCU, UPS_ALONE_SMF, BATTERY_ALONE_SMF, UPS_BATTERY_SMF, UPS_ALONE_TUBE, BATTERY_ALONE_TUBE, UPS_BATTERY_TUBE, PRODUTIVITY_DAY, POINTS_DAY, POINTS_PRODUCT, DC_SIGN_WORK) 
			VALUES ('".$_POST["PNAME"]."', '".$_POST["DELI_INSTA"]."', '".$_POST["DELIVERY_ALONE"]."', '".$_POST["INSTALLATION_ALONE"]."', '".$_POST["Lug_Work"]."', '".$_POST["PCB_Coating"]."', '".$_POST["Testing"]."', '".$_POST["Packing"]."', '".$_POST["External_Rectfi"]."', '".$_POST["PCB_Power_Components"]."', '".$_POST["Cntrl_PCB"]."', '".$_POST["Charger_PCB"]."', '".$_POST["Inverter_PCB"]."', '".$_POST["others"]."', '".$_POST["HUPS_WITH_TUBULAR_BATTERY"]."', '".$_POST["ONLINE_UPS_WITH_SMF_BATTERY"]."', '".$_POST["ONLINE_UPS_WITH_TUBULAR_BATTERY"]."', '".$_POST["OFFGRID_SOLAR_PCU"]."', '".$_POST["ONGRID_SOLAR_PCU"]."', '".$_POST["UPS_ALONE_SMF"]."', '".$_POST["BATTERY_ALONE_SMF"]."', '".$_POST["UPS_BATTERY_SMF"]."', '".$_POST["UPS_ALONE_TUBE"]."', '".$_POST["BATTERY_ALONE_TUBE"]."', '".$_POST["UPS_BATTERY_TUBE"]."', '".$_POST["PRODUTIVITY_DAY"]."', '".$_POST["POINTS_DAY"]."', '".$_POST["POINTS_PRODUCT"]."', '".$_POST["DC_SIGN_WORK"]."')";
		$isUpdated = mysqli_query($this->dbConnect, $insertQuery);		
	}
	public function deletePoints(){
		if($_POST["empId"]) {
			$sqlDelete = "
				DELETE FROM ".$this->empTable."
				WHERE ID = '".$_POST["empId"]."'";		
			mysqli_query($this->dbConnect, $sqlDelete);		
		}
	}
}
?>