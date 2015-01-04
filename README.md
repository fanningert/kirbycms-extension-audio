# KirbyText Extension - Audio

*Version:* 0.3

Display a audio via the HTML5 audio tag.

**IMPORTANT:** In the current version of Kirby (2.0.5) is a bug. So every file with a extension that has a number and a upper case letter can not be found. Here the [issue](https://github.com/getkirby/kirby/issues/158) on GitHub.

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
(audio: ogg: demo-audio.ogg mp3: demo-audio.mp3)
```

### with external urls

```
(audio: ogg: http://demos.w3avenue.com/html5-unleashed-tips-tricks-and-techniques/demo-audio.ogg mp3: http://demos.w3avenue.com/html5-unleashed-tips-tricks-and-techniques/demo-audio.mp3)
```