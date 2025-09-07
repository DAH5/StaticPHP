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

The above example will ensure that only the source files are commited to Git because the generated output files can be regenerated anytime, so make sure to replace `public` with your chosen folder/directory name. It also includes an entry to ignore `StaticPHP.php` which is recommended when using the launcher to ensure the main StaticPHP file does not get commited too. If you are not using the launcher, you may want this file included, so simply remove that line. Lines that start with a hash symbol `#` are comments.

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

This method is less recommended due to the potential difficulty in remembering configuration options. However, for those who prefer this approach, there are two ways to do it.

Firstly, you need to know what each configurable option does when defined via command line arguments.

- `source_dir_path`: The path relative to StaticPHP that contains your source input files.
- `output_dir_path`: The path relative to StaticPHP that contains your generated output files.
- `items_to_ignore`: Any string of text in file paths that StaticPHP should ignore as individual files. Useful for PHP includes that you don't want to output.
- `friendly_urls`: A boolean (true/false) indicating whether StaticPHP should create friendly URLs (e.g., `domain.tld/page`) or keep the paths the same as the source (e.g., `domain.tld/page.html`).
- `metadata_delimiter`: A delimiter indicating where Metadata starts and ends. See the [Metadata](MetaData.md) page for more details.
- `minify_html`: A boolean indicating whether StaticPHP should minify HTML files. This affects only the output files; source files remain unminified.
- `minify_css`: A boolean indicating whether StaticPHP should minify CSS files. This affects only the output files; source files remain unminified.
- `minify_js`: A boolean indicating whether StaticPHP should minify JavaScript files. This affects only the output files; source files remain unminified.
- `minify_html_tags_to_preserve`: A string containing a single HTML tag name to preserve and not minify. Useful for things like code snippets using the `<pre>` tag. Ommit entirely if not needed.
- `bulk_redirects_filename`: A string containing your preferred filename for the bulk redirects file. Defaults to `_bulk_redirects` if not specified.
- `redirection_template_filename`: A string containing your preferred filename for the redirection template file. Defaults to `_redirection_template.html` if not specified.
- `minify_css_inplace`: A boolean indicating whether StaticPHP should minify CSS files in-place or separate. Defaults to `true`. See the [Customisation](Customisation.md) page for more details.
- `items_to_passthrough`: Any string of text in file paths that StaticPHP should passthrough instead of process. Useful if you want a PHP script to remain intact and exist in the output.

To define these options via command line arguments, make sure you have a terminal open with the path set to your project directory/folder.

Now choose which command line argument method you wish to use.

#### Named Flags Method

Named flags make it easy to define your configurable options via command line arguments in absolutely any order you choose. They look like `--configurable-option=value`.

Form a command similar to the following...

```bash
php StaticPHP.php [named-flags]
```

Now replace `[named-flags]` with your list of flags in the format of `--configurable-option=value`, where `configurable-option` is the name from the above list, and `value` being what you want to set that configurable option to.

##### Example Named Flags Command

Here is an example command usage where the source directory path and output directory paths are defined...

```bash
php StaticPHP.php --source_dir_path=src --output_dir_path=public
```

You can define as many or as few options as you want. There are safe defaults set inside StaticPHP which will be used for any configurable option you have not specified your own value for.

#### Positional Arguments Method

This is the very first way StaticPHP came into operation, and was used mostly for internal testing. It's recommeended to be used due to its complexity and how messy it is, but it has been left intact incase it is needed during testing, or someone else wishes to use it too.

You simply define the above options in order by just specifying their value in the order they appear.

##### Syntax of Positional Arguments Command

```bash
php StaticPHP.php source_dir_path output_dir_path items_to_ignore friendly_urls metadata_delimiter minify_html minify_css minify_js minify_html_tags_to_preserve bulk_redirects_filename redirection_template_filename minify_css_inplace items_to_passthrough
```

##### Example Positional Arguments Command

Here is an example command usage where the source directory path and output directory paths are defined...

```bash
php StaticPHP.php src public
```

You can define as many or as few options as you want. There are safe defaults set inside StaticPHP which will be used for any configurable option you have not specified your own value for.

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
$minify_html_tags_to_preserve = array();
$bulk_redirects_filename = "_bulk_redirects";
$redirection_template_filename = "_redirection_template.html";
$minify_css_inplace = true;
$items_to_passthrough = array();

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
    $minify_js,
    $minify_html_tags_to_preserve,
    $bulk_redirects_filename,
    $redirection_template_filename,
    $minify_css_inplace,
    $items_to_passthrough
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

