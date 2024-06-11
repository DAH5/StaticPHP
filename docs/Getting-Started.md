# Getting Started

*Your next project begins here.*

## Step One: Download and Install

Download the latest version to your project folder/directory. It is recommended to download the launcher, as this will keep you up-to-date with the latest StaticPHP features and provide easy customization options.

## Step Two: Develop Your Website

Start creating HTML and PHP files, and let StaticPHP handle the rest. Ensure that any file paths, such as those for including other files, are relative to the location of the StaticPHP file.

Refer to the [MetaData](MetaData.md) feature to explore additional capabilities for your website files.

## Step Three: Build and Deploy

Run StaticPHP to generate the static version of your website in the output folder/directory.

If using the launcher, simply run the following command:

```bash
php StaticPHP-Launcher.php
```

For those using the StaticPHP file itself, there are two options:

### Using Command-Line Parameters

This method is less recommended due to the potential difficulty in remembering configuration options. However, for those who prefer this approach, here’s how to do it:

Open a terminal in your project directory/folder, and type the following command, adjusting the parameters to suit your project:

```bash
php StaticPHP.php PATH_TO_INPUT_FILES_DIR PATH_TO_OUTPUT_FILES_DIR PATH_PART_TO_IGNORE FRIENDLY_URLS_BOOL METADATA_DELIMITER MINIFY_HTML_BOOL MINIFY_CSS_BOOL MINIFY_JS_BOOL
```

- `PATH_TO_INPUT_FILES_DIR`: The path relative to StaticPHP that contains your source input files.
- `PATH_TO_OUTPUT_FILES_DIR`: The path relative to StaticPHP that contains your generated output files.
- `PATH_PART_TO_IGNORE`: Any string of text in file paths that StaticPHP should ignore as individual files. Useful for PHP includes that you don't want to output.
- `FRIENDLY_URLS_BOOL`: A boolean (true/false) indicating whether StaticPHP should create friendly URLs (e.g., `domain.tld/page`) or keep the paths the same as the source (e.g., `domain.tld/page.html`).
- `METADATA_DELIMITER`: A delimiter indicating where Metadata starts and ends. See the [Metadata](MetaData.md) page for more details.
- `MINIFY_HTML_BOOL`: A boolean indicating whether StaticPHP should minify HTML files. This affects only the output files; source files remain unminified.
- `MINIFY_CSS_BOOL`: A boolean indicating whether StaticPHP should minify CSS files. This affects only the output files; source files remain unminified.
- `MINIFY_JS_BOOL`: A boolean indicating whether StaticPHP should minify JavaScript files. This affects only the output files; source files remain unminified.

### Using a Custom Launcher Script

You can create a custom launcher script for more flexibility. Here is an example:

```php
<?php

$path_to_input_files_dir = __DIR__ . DIRECTORY_SEPARATOR . 'src';
$path_to_output_files_dir = __DIR__ . DIRECTORY_SEPARATOR . 'public';
$path_parts_to_ignore = array( '_includes' );
$friendly_urls_bool = true;
$metadata_delimiter = '---';
$minify_html_bool = true;
$minify_css_bool = true;
$minify_js_bool = true;

include __DIR__ . DIRECTORY_SEPARATOR . 'StaticPHP.php';

new StaticPHP
(
    $path_to_input_files_dir,
    $path_to_output_files_dir,
    $path_parts_to_ignore,
    $friendly_urls_bool,
    $metadata_delimiter,
    $minify_html_bool,
    $minify_css_bool,
    $minify_js_bool
);
```

By following these steps, you can get started with StaticPHP and easily build and deploy your static websites. For more detailed information, refer to the accompanying documentation and guides.

