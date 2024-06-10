# MetaData

An area at the top of your source files where you can store information that you can refer back to later, or for StaticPHP to use as part of special metadata.

## Defining MetaData

To define MetaData, you put it at the top of your file with the first line being the MetaData Delimiter you set as build configuration. If you haven't defined a delimiter yet, you can do so using the information on the [Getting Started](Getting-Started.md) page, or use the default delimiter of triple hyphens (---).

Here is an example of MetaData at the top of a source file.

```
---
some_key: some value
another_key: another value
---
```

Keys and values are separated by a colon and usually a space for clarity. The word key does not need to be part of the key, and the word value does not need to be part of the value, these were put there purely for illustration purposes and clarity.
Placeholders

You can display MetaData values using MetaData placeholders. These are formed using the MetaData Delimiter on either end, the word metadata and a dot and then the key name as defined in metadata you wish to retrieve, similar to accessing an object property in some programming languages. StaticPHP will replace this with the value associated with that key during the build process if a matching key exists in metadata.

In the previous example where it shows how to define metadata, we set two keys with associated values. Here is an example of how you can retrieve these values again later.

```html
<p>--- metadata.some_key ---</p>

<p>--- metadata.another_key ---</p>
```

The output of having the metadata example and the above placeholders example will be like this.

```html
<p>some value</p>

<p>another value</p>
```

## Special MetaData

These are things defined in MetaData that are used internally by StaticPHP. Defining these special metadata keys with a value will tell StaticPHP to do something differently.

### Overriding Friendly URLs

As it explains on the [Getting Started](Getting-Started.md) page, you can set friendly URLs to true or false globally, but you can also change this value on a per-page basis. If StaticPHP sees you have set the metadata key friendly_urls to either true or false, it will honor this over the global setting.

### Custom Output Path

By default, StaticPHP will use the Friendly URLs setting to decide what the output path should be. If you wish the output filename to be different, you can set this on a per-page basis. Simply set the metadata key custom_output_path to the path you wish the output file to be located.

### Base Layouts

One problem you may come across with static websites is how to maintain the same base layout across all pages. You could copy and paste the same header and footer into each page, but this can easily get messy and become a headache as the content on your site grows, as you would need to update each page with the changes you wish to make.

Another option, which would make this a lot easier, is to use PHP includes, but that would mean all your pages would need to be PHP based, which may not suit your sites needs. As StaticPHP grows in features, alternative file formats may become available, such as Markdown and basic HTML, so PHP would not be a solution in those cases.

StaticPHP makes maintaining the same base layout across all pages easy.

Simply add the metadata key layout in the source file of the page you wish the base layout applied to with the value being the path to the base layout file.

```html
---
page_title: Awesome Page
layout: SOURCE-FILES/IGNORE-FILES/base-layout.php
---

<h2>--- metadata.page_title ---</h2>

<p>This is a very awesome page. I am so glad you checked it out! :)</p>
```

In the base layout file, add metadata key content_placeholder and set it to what you want to use as a placeholder for your page content. This will be where the content of that specific page will be placed.

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

