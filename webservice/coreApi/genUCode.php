<?php
require_once('memMgr.php'); 

/**
*	CLASS	:	A class to generate unique codes
*/
class UniqueCodeGenerator extends memoryMgr{	

	const acceptableDataSize = 30000000; //30 Million
	
	/**
 	*	Constructor
 	*/
	public function __construct(){
		parent::__construct();
	}
	
	/**
 	*	FUNCTION	:	getUniqueCode		:	Generate single Unique Code Id.
	*	INPUT		:	$uniqueCodeLength	:	Length of Code to be Generated. E.g. 8 Digit Code / 16 Digit Code.
	*	RETURN		:	$uniqueCode			:	Returns a single unique code value
 	*/
	public function getUniqueCode($uniqueCodeLength){
	
		//To Pull N Unique Random Values Out Of AlphaNumeric
		//removed number 0, capital o, number 1 and small L
		//Total: keys = 32, elements = 33
		$characters = array(
							"A","B","C","D","E","F","G","H","J","K","L","M",
							"N","P","Q","R","S","T","U","V","W","X","Y","Z",
							"2","3","4","5","6","7","8","9");
	
		//make an "empty container" or array for our keys
		$keys = array();
		
		//first count of $keys is empty so "1", remaining count is 1-7 = total 8 times
		while(count($keys) < $uniqueCodeLength) {
			//"0" because we use this to FIND ARRAY KEYS which has a 0 value
			//"-1" because were only concerned of number of keys which is 32 not 33
			//count($characters) = 33
			$x = mt_rand(0, count($characters)-1);
			if(!in_array($x, $keys)) {
				$keys[] = $x;
			}
		}
		
		foreach($keys as $key){
			$uniqueCode .= $characters[$key];
		}
		
		return $uniqueCode;
	}
	
	/**
 	*	FUNCTION	:	getNUniqueCodes		:	Generate N number of Unique Code Ids.
	*	INPUT		:	$uniqueCodeLength	:	Length of Code to be Generated. E.g. 8 Digit Code / 16 Digit Code.
	*	RETURN		:	$uniqueCodes			:	Returns N number of unique Codes/ Array of Unique codes
 	*/
	public function getNUniqueCodes($uniqueCodeLength, $uCodeNum){
		$dataSize = $uniqueCodeLength*$uCodeNum;
		
		if($dataSize > self::acceptableDataSize){
			echo "FATAL ERROR: Application Cannot accept $uniqueCodeLength*$uCodeNum > ".self::acceptableDataSize."<br>\n";
			return false;
		}
		
		ini_set("max_execution_time", 90);
		
		if($this->setMemory($dataSize)){
			for($uCount=0; $uCount < $uCodeNum; $uCount++){
				$uniqueCodeArr[$uCount] = $this->getUniqueCode($uniqueCodeLength);
			}
			$this->resetMemory();
			return $uniqueCodeArr; 
		}
		else
			return false;
	}
}//UniqueCodeGenerator END
?>