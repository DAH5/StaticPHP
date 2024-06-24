# Functional Blocks

Functional Blocks in StaticPHP allow you to create dynamic content without writing PHP. They are similar to using PHP functions but with a simplified syntax.

## Syntax

A Functional Block starts with an opening tag using the same delimiter as MetaData, followed by the block name, and then a set of key-value parameters within parentheses. The block is closed with an end tag, which is the word "end" followed by the block name, surrounded by the MetaData delimiter.

Here's an example:

```plaintext
--- func(key = "value", another-key = "another-value") ---

Put anything here.

--- endfunc ---
```

## The Loop Functional Block

The `loop` block allows you to iterate through a list of items and display information for each item as you define.

### Directory Contents

Use the `dir` parameter to loop through each file in a directory. You can specify an absolute path or a relative path (without a leading slash). Relative paths are relative to the location of the StaticPHP file, not the file containing the loop block.

You can access MetaData within each file using placeholders prefixed with "loop" instead of "metadata."

Example:

```plaintext
--- loop(dir = "src/items") ---

Item Name: --- loop.item-name ---

--- endloop ---
```

For more information on setting MetaData in files and using placeholders, refer to the [MetaData](MetaData.md) page.

A special placeholder `--- loop.uri ---` is available when using the `dir` parameter, displaying the path to the current directory item for use in links.

### Sorting Order

By default, items are sorted as the filesystem sorts them, typically in ascending order. You can change this by setting the `sort` parameter to either `ascending` or `descending`.

Example of sorting with `dir`:

```plaintext
--- loop(dir = "src/items", sort = "descending") ---

Item Name: --- loop.item-name ---

--- endloop ---
```

### Outputting JSON

You can make the loop results available as a JSON file by setting the `json` parameter to the desired file path. Similar to `dir`, this path can be relative to StaticPHP or absolute.

Example of JSON output:

```plaintext
--- loop(dir = "src/items", json = "src/api/items.json") ---

Item Name: --- loop.item-name ---

--- endloop ---
```

### Ignoring Items

You can specify additional items for the loop to ignore using the `ignores` parameter. This parameter takes a semicolon-separated list of items to ignore, optionally with spaces for readability.

Example of ignoring items:

```plaintext
--- loop(dir = "src/items", ignores = "ignore-this; ignore-that") ---

Item Name: --- loop.item-name ---

--- endloop ---
```

## The If Functional Block

The `if` functional block allows you to perform conditional checks on MetaData.

### Example of Use

Assume you have the following MetaData at the top of your home page file, indicating that this page is the home page.

```plaintext
---
current-page: home
---
```

You can perform a check that the current page is the home page using the following `if` functional block.

```html
--- if( current-page == "home" ) ---
    <p>This is the home page.</p>
--- endif ---
```

When the condition is true, it will output the content inside.

```html
<p>This is the home page.</p>
```

It is currently only limited to this basic functionality. The functionality may get extended in the future.

## More Features Coming Soon

Stay tuned for updates and additional features in the documentation.

