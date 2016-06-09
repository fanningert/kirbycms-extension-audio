<?php

namespace at\fanninger\kirby\extension\audioext;

/**
 * @package AudioExt
 * @author Thomas Fanninger <thomas@fanninger.at>
 * @link https://github.com/fanningert/kirbycms-extension-audio
 */
class AudioExt {
	
	/**
	 * **************************************************************************
	 */
	const SNIPPET_NAME = 'snippet_name';
	const AUDIO_CLASS = 'class';
	const OPTION_PRELOAD = 'preload';
	const OPTION_CONTROLS = 'controls';
	const OPTION_LOOP = 'loop';
	const OPTION_MUTED = 'muted';
	const OPTION_AUTOPLAY = 'autoplay';
	const CAPTION = 'caption';
	const CAPTION_TOP = 'caption_top';
	const CAPTION_CLASS = 'caption_class';
	const SOURCES = 'sources';
	
	const TYPE_M4A = 'audio/x-aac';
	const TYPE_MP3 = 'audio/mpeg';
	const TYPE_OGG = 'audio/ogg';
	const TYPE_WAV = 'audio/wav';
	
	/**
	 * **************************************************************************
	 */
	private $page = null;	
	private $options = array( 
			AudioExt::SNIPPET_NAME => null,
			AudioExt::AUDIO_CLASS => 'audio',
			AudioExt::OPTION_PRELOAD => false,
			AudioExt::OPTION_CONTROLS => true,
			AudioExt::OPTION_LOOP => false,
			AudioExt::OPTION_MUTED => false,
			AudioExt::OPTION_AUTOPLAY => false,
			AudioExt::CAPTION => null,
			AudioExt::CAPTION_TOP => false,
			AudioExt::CAPTION_CLASS => 'audio',
			AudioExt::SOURCES => array () 
	);
	
	/**
	 *
	 * @param \Page $page
	 */
	public function __construct(\Page $page) {
		$this->page = $page;
		
		// if ($this->page instanceof \Page) {
		// throw new AudioExtException ( AudioExtException::missing_page_object );
		// }
		
		$this->setOption ( AudioExt::SNIPPET_NAME, kirby ()->option ( 'kirby.extension.audioext.snippet_name', $this->options[AudioExt::SNIPPET_NAME] ) );
		$this->setOption ( AudioExt::AUDIO_CLASS, kirby ()->option ( 'kirby.extension.audioext.class', $this->options[AudioExt::AUDIO_CLASS] ) );
		$this->setOption ( AudioExt::OPTION_PRELOAD, kirby ()->option ( 'kirby.extension.audioext.preload', $this->options[AudioExt::OPTION_PRELOAD] ) );
		$this->setOption ( AudioExt::OPTION_CONTROLS, kirby ()->option ( 'kirby.extension.audioext.controls', $this->options[AudioExt::OPTION_CONTROLS] ) );
		$this->setOption ( AudioExt::OPTION_LOOP, kirby ()->option ( 'kirby.extension.audioext.loop', $this->options[AudioExt::OPTION_LOOP] ) );
		$this->setOption ( AudioExt::OPTION_MUTED, kirby ()->option ( 'kirby.extension.audioext.muted', $this->options[AudioExt::OPTION_MUTED] ) );
		$this->setOption ( AudioExt::OPTION_AUTOPLAY, kirby ()->option ( 'kirby.extension.audioext.autoplay', $this->options[AudioExt::OPTION_AUTOPLAY] ) );
		$this->setOption ( AudioExt::CAPTION, kirby ()->option ( 'kirby.extension.audioext.caption', $this->options[AudioExt::CAPTION] ) );
		$this->setOption ( AudioExt::CAPTION_TOP, kirby ()->option ( 'kirby.extension.audioext.caption_top', $this->options[AudioExt::CAPTION_TOP] ) );
		$this->setOption ( AudioExt::CAPTION_CLASS, kirby ()->option ( 'kirby.extension.audioext.caption_class', $this->options[AudioExt::CAPTION_CLASS] ) );
	}
	
	public function setOption($opt_name, $opt_value) {
		if (array_key_exists ( $opt_name, $this->options ))
			$this->options [$opt_name] = $opt_value;
		
		return $this;
	}
	public function getOption($opt_name) {
		if (array_key_exists ( $opt_name, $this->options )) {
			return $this->options [$opt_name];
		} else {
			throw new AudioExtException ( AudioExtException::unknown_option );
		}
	}
	
	/**
	 * Add a new Source
	 *
	 * @param string $audio       	
	 * @param string $type        	
	 * @param string $media        	
	 * @return AudioExt
	 */
	public function addSource($audio, $type = null, $media = null) {
		if (! empty ( $audio )) {
			$this->options [AudioExt::SOURCES] [] = array (
					'src' => $audio,
					'type' => $type,
					'media' => $media 
			);
		}
		return $this;
	}
	
	/**
	 * Check if the caption should print at the top.
	 *
	 * @return boolean
	 */
	public function isCaptionTop() {
		return $this->getOption ( AudioExt::CAPTION_TOP );
	}
	
	/**
	 * Generate the HTML-Code of the audio tag.
	 *
	 * @return string
	 */
	public function toHtml() {		
		// Check if snippet set and snippet exist
		if ($this->getOption ( AudioExt::SNIPPET_NAME ) != null && file_exists ( $kirby->roots->snippets () . '/' . $this->getOption ( AudioExt::SNIPPET_NAME ) . '.php' )) {
			$snippet = ( string ) $this->getOption ( AudioExt::SNIPPET_NAME );
			return ( string ) snippet ( $snippet, $options, true );
		} else {
			// Create over BRICK
			$audio = new \Brick ( 'audio' );
			
			// Add options
			if ($this->getOption ( AudioExt::AUDIO_CLASS ) != null)
				$audio->addClass ( $this->getOption ( AudioExt::AUDIO_CLASS ) );
			if ($this->getOption ( AudioExt::OPTION_PRELOAD ) != false)
				$audio->attr ( 'preload', $this->getOption ( AudioExt::OPTION_PRELOAD ) );
			if ($this->getOption ( AudioExt::OPTION_CONTROLS ) == true)
				$audio->attr ( 'controls', 'controls' );
			if ($this->getOption ( AudioExt::OPTION_LOOP ) == true)
				$audio->attr ( 'loop', 'loop' );
			if ($this->getOption ( AudioExt::OPTION_MUTED ) == true)
				$audio->attr ( 'muted', 'muted' );
				
				// Add Sources
			foreach ( $this->options [AudioExt::SOURCES] as $source ) {
				$audio_source = new \Brick ( 'source' );
				
				$file = $this->page->file ( $source ['src'] );
				$url_audio = ($file) ? $file->url () : $source ['src'];
				$audio_source->attr ( 'src', $url_audio );
				
				if ($source ['type'] != null)
					$audio_source->attr ( 'type', $source ['type'] );
				if ($source ['media'] != null)
					$audio_source->attr ( 'media', $source ['media'] );
				$audio->append ( $audio_source );
			}
			
			// Add optional caption
			$figure_caption = '';
			if ($this->getOption ( AudioExt::CAPTION ) != null) {
				$caption = ( string ) $this->convert ( $this->getOption ( AudioExt::CAPTION ) );
				$figure_caption = new \Brick ( 'figcaption', $caption );
			}
			
			if ($this->getOption ( AudioExt::CAPTION ) != null) {
				$figure = new \Brick ( 'figure' );
				if ($this->getOption ( AudioExt::CAPTION_CLASS ) != null)
					$figure->addClass ( $this->getOption ( AudioExt::CAPTION_CLASS ) );
				if ($this->isCaptionTop () && ! empty ( $figure_caption )) {
					$figure_caption->addClass ( 'caption-top' );
					$figure->append ( $figure_caption );
				}
				$figure->append ( $audio );
				if (! $this->isCaptionTop () && ! empty ( $figure_caption )) {
					$figure_caption->addClass ( 'caption-bottom' );
					$figure->append ( $figure_caption );
				}
				
				return ( string ) $figure->toString ();
			} else {
				return ( string ) $audio->toString ();
			}
		}
	}
	
	/**
	 * Overwrite of the super method
	 */
	public function __toString() {
		$this->toHtml ();
	}
	
	/**
	 * Replace not allowed character in the text with replacements.
	 *
	 * @param string $text
	 * @return string
	 */
	protected function convert($text) {
		return ( string ) htmlentities ( $text );
	}
	
	/**
	 * This static method is executed by kirbytag method.
	 *
	 * @param unknown $tag
	 * @return string Generated HTML-Code for the HTML5-Audio-KirbyTag
	 */
	public static function executeTag($tag, $tag_name = 'audioext') {
		try {
			$audioext = new AudioExt ( $tag->page () );
				
			foreach ( \kirbytext::$tags [$tag_name] ['attr'] as $name ) {
				if (! empty ( $value = $tag->attr ( $name ) ))
					$audioext->setOption ( $name, $value );
			}
				
			// Sources
			$audioext->addSource ( $tag->attr ( 'm4a' ), AudioExt::TYPE_M4A );
			$audioext->addSource ( $tag->attr ( 'mp3' ), AudioExt::TYPE_MP3 );
			$audioext->addSource ( $tag->attr ( 'ogg' ), AudioExt::TYPE_OGG );
			$audioext->addSource ( $tag->attr ( 'wav' ), AudioExt::TYPE_WAV );
				
			return $audioext->toHtml ();
		} catch ( AudioExtException $e ) {
			echo 'Exception: ', $e->getMessage (), "\n";
		}
	}
}

/**
 *
 * @package AudioExt
 * @author Thomas Fanninger <thomas@fanninger.at>
 * @link https://github.com/fanningert/kirbycms-extension-video
 */
class AudioExtException extends \Exception {
	const unknown_option = 1;
	const missing_page_object = 2;
	public function __construct($code, $message = null, $previous = null) {
		$this->code = $code;
		
		if ($message == null)
			$message = $this->generateMessageForCode ();
		
		parent::__construct ( $message, $code, $previous );
	}
	public function __toString() {
	}
	private function generateMessageForCode() {
		switch ($this->code) {
			case 2 :
				return 'Missing page object';
			case 1 :
				return 'Unknown option';
			default :
				return 'Unknown error';
		}
	}
	public function toHtml() {
	}
}
