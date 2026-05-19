# MetaData

MetaData is an area at the top of your source files where you can store information for later reference or for StaticPHP to use during the build process.

## Defining MetaData

To define MetaData, place it at the top of your file with the first line being the MetaData delimiter set in your build configuration. If you haven't defined a delimiter yet, follow the instructions on the [Getting Started](Getting-Started.md) page, or use the default delimiter of triple hyphens (---).

Here is an example of MetaData at the top of a source file:

```
---
some_key: some value
another_key: another value
---
```

Keys and values are separated by a colon and a space for clarity. Replace `some_key` and `some value` with your actual metadata keys and values.

Optionally, you can use a different closing delimiter if you defined it in your build configuration, assuming `{%` and `%}` as the opening and closing delimiter.

```
{%

some_key: some value
another_key: another value

%}
```

The rest of this page will assume `---` for both the open and close delimiters to keep things simple, just remember to swap them out accordingly.

### MetaData Lists

Lists in MetaData utilise multiple lines to assign multiple values to the one MetaData key.

```
---
shopping_list:
- Bread
- Butter
- Milk
- Coffee
---
```

You can use different delimiters like: `-`, `+`, `*`.

```
---
change_log:
+ Added an awesome feature.
- Removed an unwanted feature.
* Fixed a buggy feature.
---
```

## Using Placeholders

You can display MetaData values using placeholders. These are formed using the MetaData delimiter on either end, the word `metadata`, a dot, and then the key name. StaticPHP will replace this with the value associated with that key during the build process.

### HTML and PHP Files

For example, given the MetaData above, you can retrieve these values like this:

```html
<p>--- metadata.some_key ---</p>
<p>--- metadata.another_key ---</p>
```

This will output:

```html
<p>some value</p>
<p>another value</p>
```

### CSS Files

For example, this CSS source code:

```css
---
primary_color: #ff0000
secondary_color: #ffff00
---
.metadata
{
    background-color: --- metadata.primary_color ---;
    color: --- metadata.secondary_color ---;
}

.metadata-alt
{
    background-color: --- metadata.secondary_color ---;
    color: --- metadata.primary_color ---;
}
```

Will output this generated code:

```css
.metadata
{
    background-color: #ff0000;
    color: #ffff00;
}

.metadata-alt
{
    background-color: #ffff00;
    color: #ff0000;
}
```

### JavaScript Files

For example, this JavaScript source code:

```js
---
element_id: metadata
text: Hello, world!
---
var metadata = document.getElementById( '--- metadata.element_id ---' );

metadata.innerHTML = '--- metadata.text ---';
```

Will output this generated code:

```js
var metadata = document.getElementById( 'metadata' );

metadata.innerHTML = 'Hello, world!';
```

### MetaData Lists

Display the first item in a list with a MetaData Placeholder.

**Example Input**

```html
---
shopping_list:
- Bread
- Butter
- Milk
- Coffee
---

<p>First Shopping List Item: --- metadata.shopping_list ---</p>
```

**Example Output**

```html
<p>Bread</p>
```

### Placeholders with Different Open and Close Delimiters

If you defined a different opening and closing delimiter in your build config, for example `{%` and `%}`, you will need to ensure you use these in your placeholders.

```html
{%

some_key: some key
some_value: some value

%}

<p>{% metadata.some_key %}</p>
```

## Special MetaData

Special MetaData keys are used internally by StaticPHP to modify its behavior. Defining these keys with specific values allows you to customize the build process.

### Overriding Friendly URLs

As explained on the [Getting Started](Getting-Started.md) page, you can set friendly URLs globally. However, you can override this setting on a per-page basis by setting the `friendly_urls` MetaData key to `true` or `false`.

### Custom Output Path

By default, StaticPHP uses the Friendly URLs setting to determine the output path. To specify a custom output path for a page, set the `custom_output_path` MetaData key to the desired path.

### Base Layouts

Maintaining a consistent base layout across all pages can be challenging. StaticPHP simplifies this process by allowing you to define base layouts.

1. Add the `layout` MetaData key in the source file of the page you want the base layout applied to, with the value being the path to the base layout file.

```html
---
page_title: Awesome Page
layout: SOURCE-FILES/IGNORE-FILES/base-layout.php
---

<h2>--- metadata.page_title ---</h2>
<p>This is a very awesome page. I am so glad you checked it out! :)</p>
```

2. In the base layout file, add the `content_placeholder` MetaData key to specify where the content of the specific page will be inserted.

```html
---
content_placeholder: {{ content }}
---

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awesome Website - powered by StaticPHP</title>
  </head>
  <body>
    <h1>Awesome Website</h1>
    <p>powered by StaticPHP</p>
    <hr>
    {{ content }}
    <hr>
    <p>Copyright © Awesome Developer.</p>
  </body>
</html>
```

### Code Minification Override

For files where you wish the minification to differ from the site's global setting. Whether it be just specific files, or all except specific files, StaticPHP has you covered.

Specify the MetaData key `minify` in the HTML and PHP files you wish the override to apply to and set the value to either `true` or `false` to enable or disable respectively, overriding the global setting for those specific files. Applies to HTML, CSS, and JavaScript files.

#### Example

```html
---
minify: true
---
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>HTML Minification</title>
    </head>

    <body>
        <h1>HTML Minification</h1>
        <p>The code that makes up this file will be minified.</p>
    </body>
</html>
```

```css
---
minify: true
---
.minification
{
    font-family: sans-serif;
}
```

```js
---
minify: true
---
function minification()
{
    alert( "Minification!" );
}
```

### Minify In-Place Override

Exclusive to CSS and JavaScript files, you can control on a per-file basis whether the contents of the file are output in minified form, or as-is with the minified varient in a separate file, overriding the global build config setting. Set `minify_inplace` to `true` to replace output with minified version, and set to `false` to output to a separate file ending in `.min.css` and `.min.js` respectively.

Note: You must have minification enabled either in your build configuration or for the specific file for the in-place setting to take effect.

#### Example

```css
---
minify: true
minify_inplace: false
---
.minification
{
    font-family: sans-serif;
}
```

```js
---
minify: true
minify_inplace: false
---
function minification()
{
    alert( "Minification!" );
}
```

In some editors, the MetaData code in these files may flag errors or warnings, these can be safely ignored, as the MetaData settings at the top of the files are always removed from output.

## Conclusion

By following these steps, you can easily manage MetaData in your StaticPHP projects, enabling greater flexibility and control over your static website generation process. For more detailed information, refer to the accompanying documentation and guides.

