<?php

/**
 * Copyright (c) 2012 AD2C INDIA PVT. LTD
 *	
 *
 * @package       AD2SMILES
 * @copyright     AD2C INDIA PVT. LTD
 * @author        Rohit Soni <rohit@ad2c.co>
 * @license       Proprietary
 * @Description   This Class for Web Services.
 *                
 */
 
  include_once('config.php');

  //Get All request from browser.
  $method = $_REQUEST['method']? $_REQUEST['method']: 'GetAllData';
  $name   = $_REQUEST['name'];
  $email  = $_REQUEST['email'];
  $mobile = $_REQUEST['mobile'];
  $city   = $_REQUEST['city'];	
  $lat = $_REQUEST['lat'];
  $long = $_REQUEST['long'];
  
 class Webservices extends Database{
 
	
	private $method;
	private $city;
	private $name;
	private $email;
	private $mobile;
	private $lat;
	private $long;
		
		
	function __construct($MYSQL_HOST,$MYSQL_USER,$MYSQL_PASSWORD,$MYSQL_DB_SCHEMA,$method,$city,$name,$email,$mobile,$lat,$long) {
		
		$this->method = $method;
		$this->city = $city;
		$this->name = $name;
		$this->email = $email;
		$this->mobile = $mobile;
		$this->lat = $lat;
		$this->long = $long;
		
		parent::__construct($MYSQL_HOST,$MYSQL_USER,$MYSQL_PASSWORD,$MYSQL_DB_SCHEMA);
		
	 }
				
  public function GetAllData(){
	
  /* grab the posts from the db */
  $arrColumn = array('SmileID,Title,Description,DealerName,LocationName,Country,State,Locality,ClosestAddress,Latitude,Longitude');
  $where = "1";
  $result = $this->select(TABLE_DEALS, $arrColumn, $where);
    
   /* output in necessary format */
   header('Content-type: application/json');
   //echo json_encode($posts));
   echo json_encode($result,JSON_FORCE_OBJECT);
	
 }//End Function.


  public function GetScratchCode(){
	
  
   /* grab the posts from the db */
   $arrColumn = array('scratchCode');
   $where = "name='".$this->name."' AND mobile='".$this->mobile."' AND email='".$this->email."' AND modifyDate='".date('Y-m-d')."'";
   $result = $this->select(TABLE_SCRATCHCODE, $arrColumn, $where);
     
  if($result){
	  $ErrorArr =array('key'=>'erroe');
	  echo json_encode($ErrorArr,JSON_FORCE_OBJECT);
  }
  else{
	 
   $objUniqueCodeGenerator = new UniqueCodeGenerator();
   $scratchcode = $objUniqueCodeGenerator->getUniqueCode(6);
    
   $arrColumn = array(
					'scratchCode'=>$scratchcode,
					'name'=>$this->name,
					'mobile'=>$this->mobile,
					'email'=>$this->email,
					'modifyDate'=>date('Y-m-d'),
					'isUsed'=>1				  
		 );
			
	$result = $this->insert(TABLE_SCRATCHCODE, $arrColumn);
		 
	if($result){
	
	  $ScratchArr =array('key'=>$scratchcode);
	  echo json_encode($ScratchArr,JSON_FORCE_OBJECT);
	 }
    } 
 }//End Function.		
   
  public function GetDatabyCity(){
  
   /* grab the posts from the db */
  $arrColumn = array('SmileID,Title,Description,DealerName,LocationName,Country,State,Locality,ClosestAddress,Latitude,Longitude');
  $where = "Locality ='".$this->city."' AND SmileID = 1";
  $result = $this->select(TABLE_DEALS, $arrColumn, $where);
	
  /* output in necessary format */
  header('Content-type: application/json');
  //echo json_encode($posts));
  if($result){
	 echo json_encode($result,JSON_FORCE_OBJECT);
  }
 }//End Function.
 
 function GetCityNameByLatLong(){
	 
   include_once("googleConfig.php");
	
  //Set Data Form Gurgaon array.	 
	foreach($GurgaonArr as $Gurgaon){
	   $result[] = $Gurgaon;
	}
	 
   $url = sprintf($queryString_citySearch, $this->lat,$this->long); 

   $xml = file_get_contents($url);
   
    if($xml){ 
   
    $json = json_encode($xml);
    $str = strstr($xml,'vicinity');//die;
    $addressArr = explode('"',$str);
  
    $cityArr = explode(',',$addressArr[2]);
    $count = count($cityArr);
	
   if(is_numeric($cityArr[$count-1])){ 
	 $city = $cityArr[$count-2];
   }
   else{
	$city = $cityArr[$count-1]; 
  }
  
  $city = $city? $city: 'New delhi';
  
  /* grab the posts from the db */
  $arrColumn = array('SmileID,Title,Description,DealerName,LocationName,Country,State,Locality,ClosestAddress,Latitude,Longitude');
   $where = "SmileID =1 AND Locality ='".trim($city)."'";
   
	
    $queryResult = $this->select(TABLE_DEALS, $arrColumn, $where);
	
	foreach($queryResult as $res){
		$result[] = $res;
	}
	
   /* output in necessary format */
   header('Content-type: application/json');
   //echo json_encode($posts));
   
	if($result){
	   echo json_encode($result,JSON_FORCE_OBJECT);
     }
	  else{
		 $ErrorArr =array('key'=>'erroe');
	     echo json_encode($ErrorArr,JSON_FORCE_OBJECT);
	  }
	}

  }//End Function.
  
}//End Class.
 
  		   
 $objWebservices = new Webservices($MYSQL_HOST,$MYSQL_USER,$MYSQL_PASSWORD,$MYSQL_DB_SCHEMA,$method,$city,$name,$email,$mobile,$lat,$long);                            
 
 $objWebservices->$method();

?>