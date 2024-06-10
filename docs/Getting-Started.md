# Getting Started

*Your next project begins here.*

## Step One: Download and Install

Download the latest version to your project folder/directory. It is recommended to download the launcher, as this will keep you up to date with the latest StaticPHP features, as well as give you easy customisation options.

## Step Two: Develop Your Website

Start creating HTML and PHP files and let StaticPHP do the rest. If using any file paths, such as those for including other files, these need to be relative to where the StaticPHP file is.

Read about the [MetaData](MetaData.md) feature for more you can do with your website files.

## Step Three: Build and Deploy

Run StaticPHP to generate the static version of your website into the output folder/directory.

If using the launcher, this is as simple as running the command `php StaticPHP-Launcher.php`.

For those using the StaticPHP file itself, you have two options.

### Using Commandline Parameters

This is the least recommended option, because it is easy to forget how you set your configurable options, but some may wish to do it this way, so let's cover it.

Open a terminal in your project directory/folder, and type in the following command, replacing things to suit your project.

`php StaticPHP.php PATH_TO_INPUT_FILES_DIR PATH_TO_OUTPUT_FILES_DIR PATH_PART_TO_IGNORE FRIENDLY_URLS_BOOL METADATA_DELIMITER MINIFY_HTML_BOOL MINIFY_CSS_BOOL MINIFY_JS_BOOL`

`PATH_TO_INPUT_FILES_DIR` is the path relative to where StaticPHP is that contains your source input files.

`PATH_TO_OUTPUT_FILES_DIR` is the path relative to where StaticPHP is that contains your generated output files.

`PATH_PART_TO_IGNORE` is any string of text that will appear in file paths you wish to StaticPHP to ignore as individual files. This is useful when dealing with PHP Includes as normally you would not want these to be part of the output, but just included as normal.

`FRIENDLY_URLS_BOOL` is a boolean representing whether StaticPHP should create Friendly URLs by default or keep the paths the same as source. When enabled, this feature will create URLs like `domain.tld/page`, otherwise URLs will be like `domain.tld/page.html`.

`METADATA_DELIMITER` indicates to StaticPHP how to determine where Metadata starts and ends. Read the [Metadata](MetaData.md) page for more on this.

`MINIFY_HTML_BOOL` is a boolean representing whether StaticPHP should Minify HTML or not. When enabled, all HTML (.html) files will be minified. This just affects the output files only, source input files will remain unminified irrespective of this setting.

`MINIFY_CSS_BOOL` is a boolean representing whether StaticPHP should Minify CSS or not. When enabled, all CSS (.css) files will be minified. This just affects the output files only, source input files will remain unminified irrespective of this setting.

`MINIFY_JS_BOOL` is a boolean representing whether StaticPHP should Minify JavaScript or not. When enabled, all JavaScript (.js) files will be minified. This just affects the output files only, source input files will remain unminified irrespective of this setting.


### Using Custom Launcher Script

You can use your own custom launcher script and code it however you want. Here is an example of a launcher script.

```php
<?php

$path_to_input_files_dir = __DIR__ . DIRECTORY_SEPARATOR . 'src';

$path_to_output_files_dir = __DIR__ . DIRECTORY_SEPARATOR . 'public';

$path_parts_to_ignore = array( "_includes" );

$friendly_urls_bool = true;

$metadata_delimiter = '---';

$minify_html_bool = true;

$minify_css_bool = true;

$minify_js_bool = true;

include __DIR__ . DIRECTORY_SEPARATOR . 'StaticPHP.php';

new StaticPHP( $path_to_input_files_dir, $path_to_output_files_dir, $path_parts_to_ignore, $friendly_urls_bool, $metadata_delimiter, $minify_html_bool, $minify_css_bool, $minify_js_bool );

```

