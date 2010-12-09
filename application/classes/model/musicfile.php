<?php
require Kohana::find_file('vendor', 'Zend/Media/Id3v2');
class Model_Musicfile extends Model {
	private $data = array();
	protected $id3; 

	public function __construct($file)	{
		$this->id3 = new Zend_Media_Id3v2($file);
		$this->fetchData($file);		
	}
	
	protected function fetchData($file) {
		

		$seconds = round((int)$this->id3->tlen->text / 1000);
		$mins = floor ($seconds / 60);
        $secs = $seconds % 60;
		$size = filesize($file);
		//bit rate = 1024 * (bytes * 8 / ( (minutes * 60) + seconds ))
		$bitrate = round(($size * 8 / (($mins * 60) + $secs)) / 1000);

		$this->data['title'] = $this->id3->tit2->text;
		$this->data['artist'] = $this->id3->tpe1->text;
		$this->data['album'] = $this->id3->talb->text;
		$this->data['year'] = $this->id3->tyer->text;
		$this->data['size'] = round(($size / 1048576), 2) . " mb";
		$this->data['filename'] = basename($file);
		$this->data['bitrate'] = $bitrate . " kbps";
		$this->data['length'] = "$mins:$secs";
		$this->data['genre'] = $this->id3->tcon->text;
	}
	
	public function show() {
		return print_r($this->data);
	}
	
    public function __get($name) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return null;
    }

    public function __isset($name) {
        return isset($this->data[$name]);
    }
  
}
?>