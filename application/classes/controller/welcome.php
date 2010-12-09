<?php 
defined('SYSPATH') or die('No direct script access.');
define('MEDIAPATH', realpath('media').DIRECTORY_SEPARATOR);

class Controller_Welcome extends Controller {

	public function action_index()
	{
		//require("application/vendor/getid3/getid3/getid3.php");
		//require Kohana::find_file('vendor', 'getid3/getid3/getid3');
		//require Kohana::find_file('vendor', 'mp3/id3v2');
	    require Kohana::find_file('vendor', 'Zend/Media/Id3v2');
		
		
		$filePath = "01 City Feat. Rymetyme.mp3";
		$file = MEDIAPATH . "/" . $filePath;

		$id3 = new Zend_Media_Id3v2($file);

		$data = array();
		$seconds = round((int)$id3->tlen->text / 1000);
		$mins = floor ($seconds / 60);
        $secs = $seconds % 60;
		$size = filesize($file);
		//bit rate = 1024 * (bytes * 8 / ( (minutes * 60) + seconds ))
		$bitrate = round(($size * 8 / (($mins * 60) + $secs)) / 1000);

		$data['title'] = $id3->tit2->text;
		$data['artist'] = $id3->tpe1->text;
		$data['album'] = $id3->talb->text;
		$data['year'] = $id3->tyer->text;
		$data['size'] = round(($size / 1048576), 2) . " mb";
		$data['filename'] = basename($file);
		$data['bitrate'] = $bitrate . " kbps";
		$data['length'] = "$mins:$secs";
		$data['genre'] = $id3->tcon->text;
		

		print_r($data);
		$text = 'hello, fucking world!';	
		$this->request->response = $text;
	}

} // End Welcome
