<?php

namespace App\Library\Feeds\FileTypes;

use Sabre\XML;

/**
* 
*/
class XMLParser
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
	 * Do some funky xml to json stuff here
	 */
	public function convertToJson()
	{
		$reader = new \Sabre\Xml\Reader();
		$reader->xml($this->fileContents);
		$result = $reader->parse();

		return json_encode($result);
	}

}