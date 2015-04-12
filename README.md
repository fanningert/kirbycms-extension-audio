# Kirby Extension - AudioExt

This plugin adds a new `audio` and `audioext` Kirbytext tag which enables you to embed your music and sounds easily and HTML5 compatible.

**Attention:** In this version I changed the used custom config variable for a better usage with other extension and kirby. Also the default kirbytext tag is now `audioext` but you can reactivate the `audio` tag support via config variables.

**Info:** When you don't use the snipped, you get a wrong HTML code. This is a existend bug of kirby in version 2.0.6. In the current develop version is this bug corrected. https://github.com/getkirby/kirby/issues/226

## KirbyText options

| Option | Optional | Description |
| ------ | -------- | ----------- |
| `mp3` | X | Name of a page file or absolute URL of a external file |
| `ogg` | X | Name of a page file or absolute URL of a external file |
| `wav` | X | Name of a page file or absolute URL of a external file |
| `class` | X | see config variable `kirby.extension.audioext.class` |
| `preload` | X | see config variable `kirby.extension.audioext.preload` |
| `controls` | X | see config variable `kirby.extension.audioext.controls` |
| `loop` | X | see config variable `kirby.extension.audioext.loop` |
| `muted` | X | see config variable `kirby.extension.audioext.muted` |
| `autoplay` | X | see config variable `kirby.extension.audioext.autoplay` |
| `caption` | X | see config variable `kirby.extension.audioext.caption` |
| `caption_top` | X | see config variable `kirby.extension.audioext.caption_top` |
| `caption_class` | X | see config variable `kirby.extension.audioext.caption_class` |
| `snippet_name` | X | see config variable `kirby.extension.audioext.snippet_name` |

## Config variables

| Kirby option | Default | Values | Description |
| ------------ | ------- | ------ | ----------- |
| `kirby.extension.audioext.snippet_name` | null | null/{string} | Set the name of the snippet (example `audioext`), or false. With the false false, the script generate via Brick class the HTML code. |
| `kirby.extension.audioext.class` | `audio` | false/{string} | Define a class string for the audio element. |
| `kirby.extension.audioext.preload` | false | false/none/metadata/auto | Specifies if and how the author thinks the audio should be loaded when the page loads. |
| `kirby.extension.audioext.controls` | true | true/false | Specifies that audio controls should be displayed (such as a play/pause button etc). |
| `kirby.extension.audioext.loop` | false | true/false | Specifies that the audio will start over again, every time it is finished. |
| `kirby.extension.audioext.muted` | false | true/false | Specifies that the audio output should be muted. |
| `kirby.extension.audioext.autoplay` | false | true/false | Specifies that the audio will start playing as soon as it is ready. |
| `kirby.extension.audioext.caption` | null | null/{string} | Create a figure with a caption element over the video tag. |
| `kirby.extension.audioext.caption_top` | false | true/false | Place the caption at the top of the video player. |
| `kirby.extension.audioext.caption_class` | `audio` | {string} | Class string for the figure element. |
| `kirby.extension.audioext.audio_tag` | false | true/false | Overwrite the default `audio` kirbytext tag |

## Examples

### with files of the page

```
(audio ogg: demo-audio.ogg mp3: demo-audio.mp3)
```

### with external urls

```
(audio ogg: http://demos.w3avenue.com/html5-unleashed-tips-tricks-and-techniques/demo-audio.ogg mp3: http://demos.w3avenue.com/html5-unleashed-tips-tricks-and-techniques/demo-audio.mp3)
```

## Changelog

### v1.1

* Changed the used the default kirbytext tag from `audio` to `audioext`. It's is possible to reactivate the `audio` tag support.
* Changed the name of theis extension from "Audio" to "AudioExt". "AudioExt" stands for "Video Extended".
* Changed the used custom config variable for a better usage with other extension and kirby.
* Moved the used code into a custom class for better reusage in themes and other extension.
* Some Options and there values are changed.
* Add to the figcaption a  CSS class to realize if the tag is at the top or bottom.
* Clean up

### v1.0

* init version