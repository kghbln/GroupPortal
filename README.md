# GroupPortal

The GroupPortal extension to MediaWiki allows for group-based main page redirection.

## Installation
1. Obtain the code from [GitHub](https://github.com/kghbln/GroupPortal)
2. Extract the files in a directory called ``GroupPortal`` in your ``extensions/`` folder.
3. Add the following code at the bottom of your "LocalSettings.php" file:<br />``require_once "$IP/extensions/ImportUsers/GroupPortal.php";``
4. Go to "Special:Version" on your wiki to verify that the extension is successfully installed.
5. Done.

## Configuration
Edit the "MediaWiki:Groupportal" system message and add portals with ``user group|portal``, e.g.
```text
sysop|
*|Main Page
sysop|Administrator's noticeboard
RandomGroup|Some page
```
