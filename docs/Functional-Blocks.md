# Functional Blocks

These are blocks of code that actually do things! Think of it like using PHP, but without PHP.
Syntax

The opening tag uses the same delimiter used for MetaData, followed by the block name, then within round brackets a set of key equals value parameters separated by a comma (parameters can be in any order), and lastly the MetaData delimiter again.

Close off the block with the end tag, which is the word "end" and the block name surounded by the MetaData delimiter.

Between the opening and close tags, this is where you put the content that will appear whenever the functional block succeeds.

```
--- func( key = "value", another-key = "another-value" ) ---

Put anything here.

--- endfunc ---
```

## The Loop Functional Block

This block allows you to loop through a list of items and display information related to each item however you want.
Directory Contents

Use the dir parameter to loop through each file in a directory. You can enter an absolute path here or a relative path by negating the leading slash. For relative paths, these will be relative to StaticPHP and not the file the code is in.

Then MetaData can be used to set values within each file for you to access within the loop block using MetaData PlaceHolders.

Note that MetaData placeholders used within the loop use the "loop" prefix instead of "metadata".
Example

```
--- loop( dir = "src/items" ) ---

Item Name: --- loop.item-name ---

--- endloop ---
```

Please refer to the page on MetaData to learn more about setting MetaData in files and how to use placeholders.

A special MetaData placeholder is available when using the dir parameter and that is uri. This will display the path to the current dir item suitable for use in links.

`--- loop.uri ---`

### Sorting Order

By default, items will be sorted however the filesystem sorts them, which is usually ascending order. You can specify the sort order by setting the sort parameter to either ascending or descending.
Example of Sort using Dir

```
--- loop( dir = "src/items", sort = "descending" ) ---

Item Name: --- loop.item-name ---

--- endloop ---
```

### Outputting JSON

This feature is useful if you want to make the results of the loop available as a JSON file.

Set the json parameter to a path to where you want the JSON file to be located. Similar to the dir parameter, this path can be relative to StaticPHP or be absolute.
Example of JSON using Dir

```
--- loop( dir = "src/items", json = "src/api/items.json" ) ---

Item Name: --- loop.item-name ---

--- endloop ---
```

### Ignoring Items

The ignore list defined in your build configuration will automatically be applied, but you may wish to have the loop ignore additional items, that is where the ignores parameter comes into play.

Simply define additional items to ignore separated by a semicolon (;). Optionally add spacing to improve readability.
Example of Ignores

```
--- loop( dir = "src/items", ignores = "ignore-this; ignore-that" ) ---

Item Name: --- loop.item-name ---

--- endloop ---
```

## More Coming in the Future

For now, this is how things stand, but it is not a complete feature, so please stay tuned to this page and the other doc pages for more on how this feature expands moving forward.
