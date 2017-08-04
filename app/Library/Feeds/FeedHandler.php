<?php
namespace App\Library\Feeds;

// get our supported file type classes
use App\Library\Feeds\FileTypes\CSVParser;
use App\Library\Feeds\FileTypes\XMLParser;

/**
* 
*/
class FeedHandler
{
	
	/**
	 * @var string
	 */
	private $fileType;

	/**
	 * @var string
	 */
	private $fileContents;


	public function __construct($fileType, $fileContents)
	{
		$this->fileType = $fileType;
		$this->fileContents = $fileContents;
	}


	public function parseFile()
	{
		switch ($this->fileType) {
			case 'csv':
				$feedParser = new CSVParser($this->fileContents);
				break;

			case 'xml':
				$feedParser = new XMLParser($this->fileContents);
				break;
		}

		$feedJson = $feedParser->convertToJson();

		return $feedJson;

	}


}