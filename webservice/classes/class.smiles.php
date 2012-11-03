<?php
/**
 * Copyright (c) 2012 AD2C INDIA PVT. LTD
 *	
 *
 * @package       AD2SMILES
 * @copyright     AD2C INDIA PVT. LTD
 * @author        Rohit Soni<rohit@ad2c.co>
 * @license       Proprietary
 * @Description   smiles class.
 *                
 */
Class smiles extends Database {

  /**
	  *  @Method       __construct
	  *  @Description		Constructor method for the class. Invoke the Database constructor as well
	  */
	  function __construct($MYSQL_HOST,$MYSQL_USER,$MYSQL_PASSWORD,$MYSQL_DB_SCHEMA) {
		   parent::__construct($MYSQL_HOST,$MYSQL_USER,$MYSQL_PASSWORD,$MYSQL_DB_SCHEMA);
	  }
			
			
	
/**
  *  @Method       GenScratchCodes
  *  @Description	 Generate Scratch Codes.
  */
		
  public  function GenScratchCodes() { 
			
      include_once('coreApi/genUCode.php');
	  
	  $UniqueCodeGeneratorObj = new UniqueCodeGenerator();
	  
	  $unicodeArr = $UniqueCodeGeneratorObj->getNUniqueCodes(6, 1000);
	  
	  foreach($unicodeArr as $unicode){
	        
			$arrColumn = array(
					  'scratchCode'=>$unicode,
					  'name'=>'',
					  'mobile'=>'',
					  'email'=>'',
					  'modifyDate'=>'',
					  'isUsed'=>0
			 );
			// echo "<pre><br />";
			// print_r($arrColumn);
			// echo "<pre><br />";
	       $result = $this->insert(TABLE_SCRATCHCODE, $arrColumn);						
  						
	  }
	 
	}//End Function.
	
  public function ImportCsvData($fileName){
   
    include_once('coreApi/genCsv.php');
    
	$objcsvManager = new csvManager($fileName);
     
	$arrCsv = $objcsvManager->csvRead();
	
	// print_r($arrCsv); die;
	 
	 foreach($arrCsv as $data){
	       
			$arrColumn = array(
					  'SmileID'=>$data[0],
					  'Title'=>$data[1],
					  'Description'=>$data[2],
					  'DealerName'=>$data[3],
					  'LocationName'=>$data[4],
					  'Country'=>$data[5],
					  'State'=>$data[6],
					  'Locality'=>$data[7],
					  'ClosestAddress'=>$data[8],
					  'Latitude'=>$data[9],
					  'Longitude'=>$data[10]
			 );
			
	       $result = $this->insert(TABLE_DEALS, $arrColumn);						
  		
		print_r($data);
		echo "<br /><br />";				
	  }
  }//End Function.
 
  public function CreateDataBaseGoogleSearchAPI($dealerName , $Location){  
  
    include_once("googleConfig.php");
	
	$key =$dealerName." in ".$Location; 
    $url = sprintf($queryString_googleSearch, $key); 
	
    $xml = simplexml_load_file($url);
    
    if($xml){ 
	 foreach ($xml->result as $item){echo "here";
	   if($item->formatted_address){ 
	
   	   $AdressArr = explode(",", $item->formatted_address);
       $count =count($AdressArr);
	   $country = $AdressArr[$count-1];
	   $offer =array_rand($offerArr);
	   		 
       $arrColumn = array(
					  'SmileID'=>1,
					  'Title'=>'Deal Smile',
					  'Description'=>$offerArr[$offer],
					  'DealerName'=>$dealerName,
					  'LocationName'=>$item->name." ".$item->formatted_address,
					  'Country'=>$country,
					  'State'=>'',
					  'Locality'=>$Location,
					  'ClosestAddress'=>'',
					  'Latitude'=>$item->geometry->location->lat,
					  'Longitude'=>$item->geometry->location->lng
			 );
			
	     $result = $this->insert(TABLE_DEALS, $arrColumn);				
       }
	   else {
		echo "ERROR: OVER_QUERY_LIMIT";  die;  
	   }
     }
   }
   
 }//End Function.
 
}//End Of Class.

