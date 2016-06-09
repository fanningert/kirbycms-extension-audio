<?php

/**
 * This KirbyText is for display videos via the HTML5 audio tag.
 * Support multi source, but at the moment only one file per file type.
 *
 * Install
 * =======
 * Move this file to /site/tags/ and rename it audio.php
 * 
 * @package AudioExt
 * @author Thomas Fanninger <thomas@fanninger.at>
 * @link https://github.com/fanningert/kirbycms-extension-audio
 */
kirbytext::$tags['audioext'] = array(
  'attr' => array(
    'm4a',
    'mp3',
    'ogg',
    'wav',
    'class',
    'preload',
    'controls',
    'loop',
    'muted',
    'autoplay',
    'caption',
    'caption_top',
    'caption_class',
  	'snippet_name'
  ),
  'html' => function($tag) { 
  	return \at\fanninger\kirby\extension\audioext\AudioExt::executeTag( $tag, 'audioext' );
  }
);

if ( kirby()->option('kirby.extension.audioext.audio_tag') == true ) {
	kirbytext::$tags['audio'] = array(
			'attr' => array(
	 	    'm4a',
		    'mp3',
		    'ogg',
		    'wav',
		    'class',
		    'preload',
		    'controls',
		    'loop',
		    'muted',
		    'autoplay',
		    'caption',
		    'caption_top',
		    'caption_class',
		  	'snippet_name'
			),
			'html' => function($tag) {
				return \at\fanninger\kirby\extension\audioext\AudioExt::executeTag( $tag, 'audio' );
			}
	);
}
