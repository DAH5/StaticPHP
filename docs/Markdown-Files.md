# Markdown Files

StaticPHP has support for Markdown files. It will treat a file as markdown if it has the `.md` file extension.

You may want to use Markdown when you are writing an article of some sort where you only require simple text formatting without having to worry about HTML or PHP.

## Examples of Supported Markdown

The most used Markdown features should be supported, but if you have any specific needs, you may need to wait for this to be added in the future.

- [Paragraphs and Text](#paragraphs-and-text)
- [Headings](#headings)
- [Inline Text Formatting](#inline-text-formatting)
- [Hyperlinks](#hyperlinks)
- [Images](#images)
- [Code and Code Blocks](#code-and-code-blocks)
- [Unordered Lists](#unordered-lists)

### Paragraphs and Text

Simple lines of text forming sentenses or paragraphs can be written on their own. Linebreaks are supported too.

```
The quick brown fox jumped over the lazy dog.

The quick brown fox
jumped over the lazy dog.
```

[Back to Supported Markdown](#examples-of-supported-markdown)

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

Every heading is an anchor and can be used to create [hyperlinks](#hyperlinks) to those headings.

[Back to Supported Markdown](#examples-of-supported-markdown)

### Inline Text Formatting

You can format your text as **bold**, *italic*, and ~~strikethrough~~.

```
**bold** or __bold__
*italic* or _italic_
~~strikethrough~~
```

[Back to Supported Markdown](#examples-of-supported-markdown)

### Hyperlinks

Linking to other resources can be done too.

```
[Link Text](http://hostname.tld/resource)
```

You can also add a title to the hyperlink.

```
[Link Text](http://hostname.tld/resource "Title Text")
```

Create a link to a heading anchor.

```
[Hyperlinks](#hyperlinks)

### Hyperlinks
```

You can also use the Special MetaData key of `link_fragment_prefix` to define a prefix for fragment/anchor links. More about this on the [MetaData](MetaData.md) page.

[Back to Supported Markdown](#examples-of-supported-markdown)

### Images

Adding images is very similar to hyperlinks.

```
![Alt Text](http://hostname.tld/image.png)
```

With a title.

```
![Alt Text](http://hostname.tld/image.png "Title Text")
```

[Back to Supported Markdown](#examples-of-supported-markdown)

### Code and Code Blocks

You can write lines of code inline by surrounding the content with single backticks. `` ` ``

And you can write multiline codeblocks using three backticks on the start and end lines. You can optionally supply a language after the opening backticks.

Generated code blocks will be structured as an HTML `<pre>` tag with a `<code>` tag inside it. The `<code>` tag will have the class name of `codeblock` so you can style it as you wish. If a language was supplied, an additional class name similar to `codeblock-language` will be included, where `language` is the language specified.

If the default `codeblock-language` style of language class name doesn't work for you, it can be customised using two MetaData keys, `codeblock_language_placeholder`, which is used to style the format of the language placeholder, and by default will be set to `{{ language }}`, and `codeblock_language_class`, which is used to style the actual class name itself, and by default will be set to `codeblock-{{ language }}`, generating `codeblock-html` for an HTML code block.

#### Example Default HTML Code Block

With no customisations in MetaData, something similar to the following will be generated:

```html
<pre><code class="codeblock codeblock-html">
<!-- Some HTML code goes here. -->
</code></pre>
```

#### Example Customised HTML Code Block

With the following MetaData defined:

```html
---
codeblock_language_placeholder: {{ lang }}
codeblock_language_class: language-{{ lang }}
---
```

Something similar to the following will be generated:

```html
<pre><code class="codeblock language-html">
<!-- Some HTML code goes here. -->
</code></pre>
```

[Back to Supported Markdown](#examples-of-supported-markdown)

### Unordered Lists

You can write unordered lists by putting each list item on its own line, with each item starting with a hyphen.

```
- Item 1
- Item 2
- Another List Item
- Yet Another List Item
```

[Back to Supported Markdown](#examples-of-supported-markdown)

## MetaData Support

StaticPHP has MetaData support for Markdown files. Refer to the [MetaData](MetaData.md) documentation for more.


## Functional Blocks Support

There is currently no functional blocks support for Markdown files. This is planned and will likely be added in the future.

Functional blocks can still be used with other files. Refer to the [Functional Blocks](Functional-Blocks.md) documentation for more.

