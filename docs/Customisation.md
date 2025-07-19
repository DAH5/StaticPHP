# Customisation

StaticPHP is designed to be powerful and versatile right out of the box, catering to a wide range of needs. However, there may be times when you need to customise StaticPHP to better fit the specific requirements of your project.

StaticPHP offers many customisable options that can be defined in the build configuration, and some can be overridden on a per-file basis. Let's explore these options.

## Input Directory

The input directory is where you put all your source files. By default, this is a folder named `src` located relative to StaticPHP. You can change this to any directory you prefer.

To specify your input directory, set `source_dir_path` in your build configuration to the path where your source files are located.

## Output Directory

The output directory is where StaticPHP places the generated output files after processing. By default, this is a folder named `public` located relative to StaticPHP. You can change this to any directory you prefer.

To specify your output directory, set `output_dir_path` in your build configuration to the path where you want StaticPHP to put your generated output files.

## Ignoring Files

Sometimes you have files used only within your source files, such as configuration and include files, that you don't want processed as individual pages. You can tell StaticPHP to ignore these by placing them inside a folder and setting the name of that folder as a path part to ignore under `paths_to_ignore` in your build configuration.

If using the command line option, you can specify one path part to ignore. If using the included launcher script or a custom launcher script, you can set this as an array of path parts.

A general recommendation is to use a folder called `_includes` and add it as the path to ignore. This way, any files inside `_includes` will be ignored as individual files but still processed as intended, such as through PHP includes.

## Friendly URLs

Enhance user experience and improve SEO by enabling StaticPHP's Friendly URLs feature. This feature creates URLs like `domain.tld/page` instead of `domain.tld/page.html`.

Set `friendly_urls` in your build configuration to `true` to enable or `false` to disable Friendly URLs.

## MetaData Delimiter

By default, StaticPHP uses a triple hyphen delimiter (`---`) for MetaData, but you can change this in your build configuration under `metadata_delimiter`.

For more details, refer to the [MetaData](MetaData.md) guide.

## Code Minification

StaticPHP inherently speeds up your website by generating static files, but you can further increase speed by reducing the size of the files downloaded by users.

The code minification feature removes unnecessary spacing from your generated files, making them as small as possible while preserving content integrity. Your source files remain unaffected.

You can choose which types of files to minify (`HTML`, `CSS`, `JS`) in your build configuration, by setting `minify_html`, `minify_css`, and `minify_js` to true or false.

### Minify CSS In-Place or Separate

StaticPHP can output just the minified versions of your CSS files, which is the default behaviour, and can output both minified and unminified versions.

Set `minify_css_inplace` in your build configuration to `true` (default) to just output minified version with same name, or set to `false` to output both.

When outputing both versions, StaticPHP will put `.min.css` on the end to signify the difference between the two. For example, say you have a file called `stylesheet.css`, and you set `minify_css_inplace` to `false`, StaticPHP will give you `stylesheet.css` (unminified), as well as `stylesheet.min.css` (minified) files. When set to `true`, StaticPHP will just give you the minified version as `stylesheet.css`.

Note that for your CSS minification in-place preference to take effect, `minify_css` must be set to `true`.

**JavaScript Minification** is currently **Disabled** due to a bug in the minification process. It will be re-enabled once the bug has been fixed.

**HTML Tag Preservation:** Sometimes you may want certain tags, like `<pre>`, to remain unminified so that things like code snippets remain intact. Simply set `minify_html_tags_to_preserve` to an array of tag names in your StaticPHP configuration.

## Bulk Redirects Filename

StaticPHP supports defining all your redirection rules in a single file. By default, this filename is `_bulk_redirects`, but you can change it by setting the configuration option `bulk_redirects_filename` to your preferred filename as a string.

## Redirection Template Filename
StaticPHP outputs a simple HTML file whenever a redirection takes place. You can change the contents of the redirection file by specifying a filename for a template to use instead. Set the configuration option `redirection_template_filename` to your chosen filename relative to your source directory.

## Passing Through Items

Sometimes you may wish a PHP script or file that StaticPHP would normally process, remain in the output as-is. To make this happen, you can define the configurable option `items_to_passthrough` to an array of strings that will be matched against file paths. These can be partial matches, such as `_passthrough` as a value will match any path that has `_passthrough` as part of it.

---

For more information on customising StaticPHP, be sure to check out the [Getting Started](Getting-Started.md) guide. For options available to be overridden on a per-file basis, refer to the [MetaData](MetaData.md) guide.

