# KirbyCMS Extension - Audio

Display a audio via the HTML5 audio tag.

## Options

* *mp3*: Name of a page file or absolute URL of a external file
* *ogg*: Name of a page file or absolute URL of a external file
* *wav*: Name of a page file or absolute URL of a external file
* *preload*: (optional, Values: none/metadata/auto) The preload attribute specifies if and how the author thinks that the audio file should be loaded when the page loads.
* *controls*: (optional, Values: true/false, Default: true) Specifies that video controls should be displayed (such as a play/pause button etc).
* *loop*: (optional, Values: true/false, Default: false) Specifies that the video will start over again, every time it is finished
* *muted*: (optional, Values: true/false, Default: false) Specifies that the audio output of the video should be muted
* *autoplay*: (optional, Values: true/false, Default: false) Specifies that the video will start playing as soon as it is ready.
* *caption*: (optional) Create a figure with a caption element over the video tag
* *caption_top*: (optional, Values: true/false, Default: false) Place the caption at the top of the audio player
* *class*: (optional) Class string for the figure element

## Examples

### with files of the page

```
(audio ogg: demo-audio.ogg mp3: demo-audio.mp3)
```

### with external urls

```
(audio ogg: http://demos.w3avenue.com/html5-unleashed-tips-tricks-and-techniques/demo-audio.ogg mp3: http://demos.w3avenue.com/html5-unleashed-tips-tricks-and-techniques/demo-audio.mp3)
```

### Extended version

```
(audio muted: true)
(audio_source: demo-audio.ogg [type: audio/ogg] [media: screen and (min-width:320px)])
(audio_source: demo-audio.mp3 [type: audio/mpeg] [media: screen])
(/audio)
```