<?php

/**
 * This KirbyText is for display audios via the HTML5 audio tag.
 * Support multi source, but at the moment only one file per file type.
 *
 * Install
 * =======
 * Move this file to /site/tags/ and rename it audio.php
 * 
 * @author: Thomas Fanninger <thomas@fanninger.at>
 * @version: 0.3
 */

kirbytext::$tags['audio'] = array(
  'attr' => array(
    'mp3',
    'ogg',
    'wav',
    'audclass',
    'preload',
    'controls',
    'loop',
    'muted',
    'autoplay',
    'caption',
    'caption_top',
    'class'
  ),
  'html' => function($tag) {

    $file     = $tag->file($tag->attr('ogg'));
    $url_ogg  = ($file)?$file->url():$tag->attr('ogg');
    $file     = $tag->file($tag->attr('mp3'));
    $url_mp3  = ($file)?$file->url():$tag->attr('mp3');
    $file     = $tag->file($tag->attr('wav'));
    $url_wav  = ($file)?$file->url():$tag->attr('wav');

    $file     = $tag->file($tag->attr('audio'));
    if($file){
      switch($file->mime()){
        case 'audio/mpeg':
          $url_mp3 = $file->url();
          break;
        case 'audio/ogg':
          $url_ogg = $file->url();
          break;
        case 'audio/wav':
          $url_wav = $file->url();
          break;
      }
    };

    $preload   = $tag->attr('preload', 'metadata');
    $controls  = $tag->attr('controls', true);
    $loop      = $tag->attr('loop', false);
    $muted     = $tag->attr('muted', false);
    $autoplay  = $tag->attr('autoplay', false);
    $audclass  = $tag->attr('audclass', kirby()->option('kirbytext.audio.class', 'audio'));

    $caption  = $tag->attr('caption');
    $caption_top = $tag->attr('caption_top', false);
    $class = $tag->attr('class');
    
    if($preload != 'auto' && $preload != 'metadata' && $preload != 'none'){
      $preload = '';
    }

    $args = array(
      'mp3'      => $url_mp3,
      'ogg'      => $url_ogg,
      'wav'      => $url_wav,
      'class'    => $audclass,
      'preload'  => $preload,
      'controls' => $controls,
      'loop'     => $loop,
      'muted'    => $muted,
      'autoplay' => $autoplay
    );

    $audio = snippet('audio', $args, true);
    
    if($caption){
      $figure = new Brick('figure');
      $figure->addClass($tag->attr('class'));
      if($caption_top)
        $figure->append('<figcaption>' . html($caption) . '</figcaption>');
      $figure->append($audio);
      if(!$caption_top)
        $figure->append('<figcaption>' . html($caption) . '</figcaption>');
      return $figure;
    }else{
      return $audio;
    }
  }
);