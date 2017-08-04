<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Library\Feeds\FeedLoader;
use App\Library\Feeds\FeedHandler;

/**
* 
*/
class FeedController extends Controller
{
	

	public function processFeed(Request $request)
	{
		$feedUrl = $request->input('sourceUrl');

		// process the feed from the url
		$feedLoader = new FeedLoader($feedUrl);
		
		// need better validation - but you get the idea
		$validFeed = true;
		if(!$feedLoader->checkUrl()) $validFeed = false;
		if(!$feedLoader->checkFileType()) $validFeed = false;
		if(!$feedLoader->checkFileSize()) $validFeed = false;

		if(!$validFeed) return false;


		$fileType = $feedLoader->getFeedFileType();
		$fileContents = $feedLoader->loadFeed();

		$feedHandler = new FeedHandler($fileType, $fileContents);

		$feedJson = $feedHandler->parseFile();

		return $feedJson;

	}
	
}