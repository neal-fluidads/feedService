<?php

namespace App\Library\Feeds\FileTypes;

/**
* 
*/
class CSVParser
{

	/**
	 * @var string
	 */
	private $fileContents;
	

	public function __construct($fileContents)
	{
		$this->fileContents = $fileContents;
	}


	/**
	 * Do some funky csv to json stuff here
	 */
	public function convertToJson()
	{
		$csv = array_map("str_getcsv", explode("\n", $this->fileContents));
		$json = json_encode($csv);

		return $json;
	}

}