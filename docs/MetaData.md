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

### Using Placeholders

You can display MetaData values using placeholders. These are formed using the MetaData delimiter on either end, the word `metadata`, a dot, and then the key name. StaticPHP will replace this with the value associated with that key during the build process.

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

By following these steps, you can easily manage MetaData in your StaticPHP projects, enabling greater flexibility and control over your static website generation process. For more detailed information, refer to the accompanying documentation and guides.

