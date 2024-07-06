# Getting Started

*Your next project begins here.*

## Step One: Download and Install

Create a new folder/directory for your project (e.g. `mysite`). Download the latest version of StaticPHP to your project folder/directory. It is recommended to download the launcher instead of StaticPHP itself, as this will keep you up-to-date with the latest StaticPHP features and provide easy customization options.

## Step Two: Setup Your Project Structure

Inside your project folder/directory, decide what you want to call the folder/directory where your source files will be located (e.g. `src`) and create it.

Decide on the name of the folder/directory where your generated output files will be located (e.g. `public`) and create it.

If you are using, or plan to use, Git source control software, you may also want to create a `.gitignore` file now in the root of your project folder/directory.

**Example .gitignore file:**

```plaintext
# Ignore Generated Output Files
public
# Ignore StaticPHP File
StaticPHP.php
```

The above example will ensure that only the source files are commited to Git because the generated output files can be regenerated anytime, so make sure to replace `public` with your chosen folder/directory name. It alos includes an entry to ignore `StaticPHP.php` which is recommended when using the launcher to ensure the main StaticPHP file does not get commited too. If you are not using the launcher, you may want this file included, so simply remove that line. Lines that start with a hash symbol `#` are comments.

## Step Three: Develop Your Website

Start creating HTML and PHP files, and let StaticPHP handle the rest. Ensure that any file paths, such as those for including other files, are relative to the location of the StaticPHP file.

Refer to the [MetaData](MetaData.md) feature to explore additional capabilities for your website files.

## Step Four: Build and Deploy

Run StaticPHP to generate the static version of your website in the output folder/directory.

**JavaScript Minification** is currently **Disabled** due to a bug in the minification process. It will be re-enabled once the bug has been fixed.

If using the launcher, simply run the following command:

```bash
php StaticPHP-Launcher.php
```

For those using the StaticPHP file itself, there are two options:

### Using Command-Line Parameters

This method is less recommended due to the potential difficulty in remembering configuration options. However, for those who prefer this approach, here’s how to do it:

Open a terminal in your project directory/folder, and type the following command, adjusting the parameters to suit your project:

```bash
php StaticPHP.php source_dir_path output_dir_path items_to_ignore friendly_urls metadata_delimiter minify_html minify_css minify_js
```

- `source_dir_path`: The path relative to StaticPHP that contains your source input files.
- `output_dir_path`: The path relative to StaticPHP that contains your generated output files.
- `items_to_ignore`: Any string of text in file paths that StaticPHP should ignore as individual files. Useful for PHP includes that you don't want to output.
- `friendly_urls`: A boolean (true/false) indicating whether StaticPHP should create friendly URLs (e.g., `domain.tld/page`) or keep the paths the same as the source (e.g., `domain.tld/page.html`).
- `metadata_delimiter`: A delimiter indicating where Metadata starts and ends. See the [Metadata](MetaData.md) page for more details.
- `minify_html`: A boolean indicating whether StaticPHP should minify HTML files. This affects only the output files; source files remain unminified.
- `minify_css`: A boolean indicating whether StaticPHP should minify CSS files. This affects only the output files; source files remain unminified.
- `minify_js`: A boolean indicating whether StaticPHP should minify JavaScript files. This affects only the output files; source files remain unminified.

### Using a Custom Launcher Script

You can create a custom launcher script for more flexibility. Here is an example:

```php
<?php

$source_dir_path = __DIR__ . DIRECTORY_SEPARATOR . 'src';
$output_dir_path = __DIR__ . DIRECTORY_SEPARATOR . 'public';
$items_to_ignore = array( '_includes' );
$friendly_urls = true;
$metadata_delimiter = '---';
$minify_html = true;
$minify_css = true;
$minify_js = true;

include __DIR__ . DIRECTORY_SEPARATOR . 'StaticPHP.php';

new StaticPHP
(
    $source_dir_path,
    $output_dir_path,
    $items_to_ignore,
    $friendly_urls,
    $metadata_delimiter,
    $minify_html,
    $minify_css,
    $minify_js
);
```

## Step Five: Commit to Git

This step is optional, but if you are using Git source control, you may want to commit it now to make sure your progress is saved.

**Add All Files to Git**

`git add .`

**Commit Changes to Local Repository**

`git commit -m "Commit Message Goes Here"`

**Push to Remote**

`git push origin master`

## Conclusion

By following these steps, you can get started with StaticPHP and easily build and deploy your static websites. For more detailed information, refer to the accompanying documentation and guides.

