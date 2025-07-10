# Remote Content

StaticPHP can pull in remote content to display on a page. This is useful if you want to have one "source of truth" for content but display it in multiple places, such as documentation hosted on GitHub and your website.

## The Remote Content URL

In [MetaData](MetaData.md), set `remote_content_url` to the URL of your remote content, and StaticPHP will automatically fetch this for you.

## The Remote Content Placeholder

Fetching the content is part one, but where do you want the content displayed? In [MetaData](MetaData.md), set `remote_content_placeholder` to a placeholder of your choice (e.g. `{{ remote_content }}`), and then put that same placeholder somewhere below the MetaData section wherever you want the remote content to appear.

## Example Source Page

```html
---
remote_content_url: https://example.tld/path/to/remote-content.md
remote_content_placeholder: {{ remote_content }}
---

{{ remote_content }}

```

## What content formats are supported?

Currently, StaticPHP can only fetch Markdown content with a URL ending in `.md`. The markdown content will automatically be converted to HTML for you. Please see the [Markdown Files](Markdown-Files.md) page for more details.
