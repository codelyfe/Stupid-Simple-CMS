# Stupid Simple CMS
 Stupid Simple CMS - Created to be simple. Blog posting CMS.

## Installing Stupid Simple CMS
Download and extract all of the files to your web server.

- WWW/ <---- or 
- htdocs/ <----

### Configure Site Settings

- Text | text-centent/english.php

- Style | style/global.php

### Setting up users

- login.php | Edit section seen in code below:

```php
    $logins = array(
        'admin' => 'password',
        'admin1' => 'password',
        'admin2' => 'password'
    );
```
### Features

- ADA Compliant Tool
- Blog Posting
- Live Ajax Editing on Admin Side
- Zoom in image
- Delete Articles
- View Article on seperate page