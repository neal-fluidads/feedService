<?php
namespace App\Library\Feeds;

/**
* Handles the loading and validation of feeds from a URL
*/
class FeedLoader
{
	
	/**
	 * Maximum file upload size allowed, in bytes
	 */
	const MAX_FILE_SIZE = 1048576; # currently only 1Mb for testing

	/**
	 * @var array
	 */
	private $fileTypes;

	/**
	 * @var string
	 */
	private $url;



	public function __construct($url)
	{
		$this->fileTypes = array('csv', 'xml', 'json');
		$this->url = $url;
	}

	

	/**
	 * Downloads a feed from a URL
	 */
	public function loadFeed()
	{
		$curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, "$this->url");
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $fileData = curl_exec($curlSession);
        curl_close($curlSession);

        return $fileData;
	}


	public function getFeedFileType()
	{
		$urlParts = pathinfo($this->url);

		$fileType = $urlParts['extension'];

		// remove anything after the filename (eg. ?something=something_else)
		if(strpos($fileType, "?")) {
			$fileType = substr($fileType, 0, strpos($fileType, "?"));
		}

		return $fileType;
	}


	/**
	 * Checks for a valid url
	 *
	 * @return boolean
	 */
	public function checkUrl()
	{
		
		$url = filter_var($this->url, FILTER_SANITIZE_URL);

		if(filter_var($url, FILTER_VALIDATE_URL)) return true;

		return false;

	}


	/**
	 * Check for a supported file type
	 *
	 * @return boolean
	 */
	public function checkFileType()
	{
		$urlParts = pathinfo($this->url);

		$filename = $urlParts['filename'];
		$fileType = $urlParts['extension'];

		// remove anything after the filename (eg. ?something=something_else)
		if(strpos($fileType, "?")) {
			$fileType = substr($fileType, 0, strpos($fileType, "?"));
		}

		if(in_array($fileType, $this->fileTypes)) return true;

		return false;
	}


	/**
	 * Check the file size of a url
	 *
	 * @return boolean
	 */
	public function checkFileSize()
	{
		
		stream_context_get_default(
			array(
				'http' => array(
					'method' => 'HEAD'
				)
			)
		);

		$fileInfo = get_headers($this->url, 1);

		$fileSize = isset($fileInfo['Content-Length']) ? $fileInfo['Content-Length'] : null;

		if($fileSize <= self::MAX_FILE_SIZE) return true;

		return false;

	}


}