<?php
 
include_once('config.php');
include_once('classes/class.smiles.php');

$smilesObj = new smiles($MYSQL_HOST,$MYSQL_USER,$MYSQL_PASSWORD,$MYSQL_DB_SCHEMA);

//$smilesObj->GenScratchCodes();//This function for generate Scratch Codes randomly.

//$smilesObj->ImportCsvData('Deals');//This Function Impory data in mysql database from csv file.


 //This function to create database by Google Places API. 
// $smilesObj->CreateDataBaseGoogleSearchAPI('KFC Store','Gurgaon');//Dealer Name,Location Name
							 
?>



​

