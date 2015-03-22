<?php

class AudioExt {
	
	const OPTION_FIGURE = 'figure';
	const OPTION_FIGURE_LABEL = 'figure_label';
	
	const OPTION_AUTOPLAY = 'autoplay';
	const OPTION_CONTROLS = 'controls';
	const OPTION_LOOP = 'loop';
	const OPTION_MUTED = 'muted';
	const OPTION_PRELOAD = 'preload';
	
	const TYPE_MP3 = 'audio/mpeg';
	const TYPE_OGG = 'audio/ogg';
	const TYPE_WAV = 'audio/wav';
	
	private $page = null;	
	private $options = array( self::OPTION_AUTOPLAY => false,
			                  self::OPTION_CONTROLS => true,
							  self::OPTION_LOOP => false,
			                  self::OPTION_MUTED => false,
			                  self::OPTION_PRELOAD => false,
			                  self::OPTION_FIGURE => false,
			                  self::OPTION_FIGURE_LABEL => false 
	                        );
	private $sources = array();
	private $NoSupportMessage = array( 'en' => 'Your browser does not support the audio tag.' );
	
	public function AudioExt(Page $page){
		$this->page = $page;
	}
	
	public function addOption($name, $value){
		$this->options[$name] = $value;
	}
	
	public function setNoSupportMessage($message, $lang = 'en'){
		$this->NoSupportMessage[$lang] = $message;
	}
	
	public function addSource($file, $media_query = null){
		$this->addSource($file, null, $media_query);
	}
	
	public function addSource($file, $type, $media_query = null){
		$array_value = $this->sources[];
		$array_value['type'] = $type;
		$array_value['media'] = $media_query;
		
		$file_obj = $page->file($file);
		$url  = ($file_obj)?$file_obj->url():$file;
		$array_value['src'] = $url;
	}
	
	public function toHTML(){
		$audio = new Brick('audio');
		
		$language = $this->page->site()->language()->code();
		
		return $audio;
	}
}

kirbytext::$pre[] = function($kirbytext, $text) {
	$audio_class = new AudioExt($kirbytext->field->page);
	
	$text = preg_replace_callback('!\(audio(.*?)\)(.*?)\(audio\)!is', function($matches) use($kirbytext) {
		
	}, $text);
	
	return $audio_class->toHTML();
};