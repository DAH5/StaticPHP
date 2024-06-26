# Markdown Files

StaticPHP has support for Markdown files. It will treat a file as markdown if it has the `.md` file extension.

You may want to use Markdown when you are writing an article of some sort where you only require simple text formatting without having to worry about HTML or PHP.

## Examples of Supported Markdown

The most used Markdown features should be supported, but if you have any specific needs, you may need to wait for this to be added in the future.

### Paragraphs and Text

Simple lines of text forming sentenses or paragraphs can be written on their own. Linebreaks are supported too.

```
The quick brown fox jumped over the lazy dog.

The quick brown fox
jumped over the lazy dog.
```

### Headings

StaticPHP supports all six headings in Markdown.

```
# Heading 1
## Heading 2
### Heading 3
#### Heading 4
##### Heading 5
###### Heading 6
```

### Inline Text Formatting

You can format your text as **bold**, *italic*, and ~~strikethrough~~.

```
**bold** or __bold__
*italic* or _italic_
~~strikethrough~~
```

### Hyperlinks

Linking to other resources can be done too.

```
[Link Text](http://hostname.tld/resource)
```

You can also add a title to the hyperlink.

```
[Link Text](http://hostname.tld/resource "Title Text")
```

### Images

Adding images is very similar to hyperlinks.

```
![Alt Text](http://hostname.tld/image.png)
```

With a title.

```
![Alt Text](http://hostname.tld/image.png "Title Text")
```

### Code and Code Blocks

You can write lines of code inline by surrounding the content with single backticks. `` ` ``

And you can write multiline codeblocks using three backticks on the start and end lines. You can optionally supply a name after the opening backticks.


## MetaData Support

StaticPHP has MetaData support for Markdown files. Refer to the [MetaData](MetaData.md) documentation for more.


## Functional Blocks Support

There is currently no functional blocks support for Markdown files. This is planned and will likely be added in the future.

Functional blocks can still be used with other files. Refer to the [Functional Blocks](Functional-Blocks.md) documentation for more.

