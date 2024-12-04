# Redirections

StaticPHP supports URL redirection, which allows you to automatically redirect users from one page to another. This is particularly useful when moving or renaming pages, ensuring that old URLs continue to work seamlessly.

**Note:** Redirections are only applicable to web pages. For other types of redirects (e.g., for assets or non-HTML files), you'll need to use alternative methods.

## Bulk Redirects

The Bulk Redirects feature in StaticPHP enables you to manage multiple redirects easily using a single file: `_bulk_redirects`. This file allows you to list all your redirection rules in one place, making it simple to update or add new redirects without altering your codebase.

### Format

Each redirection rule should be placed on a new line. The format consists of two parts:
1. **Old Path:** The original URL or path that needs to be redirected.
2. **Destination Path/URL:** The target URL or new path that the original URL should point to.

These two parts should be separated by a **space**.

### Example

Here’s an example of how your `_bulk_redirects` file might look:

```plaintext
/here /there
/old.html /new.html
/about /about-us
```

In the example above:
- `/here` will be redirected to `/there`.
- `/old.html` will be redirected to `/new.html`.
- `/about` will redirect to `/about-us`.

### Notes:
- Ensure that paths in the old URL are relative (without domain or protocol) and use forward slashes `/`.
- The destination can be an absolute URL or relative path. If using an absolute URL (e.g., `https://example.tld/new`), make sure it includes the full URL structure.

This system makes it easy to handle large-scale redirects in bulk, simplifying site maintenance and ensuring a smooth user experience even after restructuring or updating content.
