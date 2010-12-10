<?php 
defined('SYSPATH') or die('No direct script access.');
define('MEDIAPATH', realpath('media').DIRECTORY_SEPARATOR);

class Controller_Dir extends Controller_DefaultTemplate {

	public function action_index() {	
		$directories = array();
		$files = array();
		$musicFiles = array();

		foreach(new DirectoryIterator(MEDIAPATH) as $file) {
			if ((!$file->isDot()) && ($file->getFilename() != basename($_SERVER['PHP_SELF']))) {
				if ($file->isDir()) {
					$directories[] = $file->getFilename();
				} else {
					$files[] = $file->getPathname();
				}	
		   }
		}

		foreach($files as $file) {
			$musicFiles[] = new Model_Musicfile($file);
		}

		//$this->request->response = count($musicFiles);
		//$view = View::factory('pages/dir');
		//$this->request->response = View::factory('pages/dir');
		
		$this->template->title = "";
		$response = array();
		$response['content'] = $musicFiles[0]->show();
		$response['items'] = $musicFiles;
		$response['directories'] = $directories;
		
		
		$this->template->content = View::factory('pages/dir', $response);
	}
	
	public function action_subdir($dir) {
		$this->request->response = "The directory is $dir!";
	}

} // End Welcome
