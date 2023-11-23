# (BETA) Stupid Simple CMS ( Blogger )
 Stupid Simple CMS - Created to be simple. Blog posting CMS.

### Last Updated: (11-22-2023)

## Version 1.1.5

```
PHP: 7.4 => 8.0+
MYSQL: No Database Needed
```

 DEMO: https://shipwr3ck.com/blog/

![StupidSimpleCMS Logo](https://i.ibb.co/HpKWcSK/Screenshot-11-12-2023-20-34-08.png)

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://github.com/codelyfe/Stupid-Simple-CMS)


   ----------

Watch Demo on YouTube: [Stupid Simple CMS](https://youtu.be/BGoWF6s8YxU)   
Donate: [Support The Developer](https://www.paypal.me/codelyfe) 


## Installing Stupid Simple CMS
Download and extract all of the files to your web server.

- WWW/ <---- or 
- htdocs/ <----


### Edit site-settings.xml within the admin folder. ( Set WebsiteURL for website to work correct )

```
<?xml version="1.0"?>
<settings>
    <title>Stupid Simple CMS</title>
    <copyright>Codelyfe.github.io</copyright>
    <websiteurl>https://shipwr3ck.com/blog/</websiteurl>
    <greetingtxt>Join the virtual story today!</greetingtxt>
</settings>

```


### Configure Site Settings

- Text | text-centent/english.php - Text Variables

- Style | settings/global.php - Global Language Select

- Style | layout/header.php - Global Header for Users

- Style | style/header-admin.php - Global Header for Admins

### Setting up users

- login.php | Edit section seen in code below:

```php
    $logins = array(
        'admin' => 'password',
        'admin1' => 'password',
        'admin2' => 'password'
    );
```

### Updating to the newest version of Stupid Simple CMS consists of saving all the .xml files, your username and password array seen in example above, and the blog-posts folder until you upload the new version of Stupid Simple CMS to your websites file server, then replacing the new .xml files and blog-posts folder with the ones you saved. 

### Features

- ADA Compliant Tool
- Blog Posting
- Live Ajax Editing on Admin Side
- Zoom in image
- Delete Articles
- View Article on seperate page
- Simple Blog Designer ( More features coming soon )
```
-- Font Color ( Body )
-- Background Color ( Body )
-- Background image ( Body )
-- Background Color ( .article ) 
-- Background Color ( .article-btn ) 
-- Font Color ( .article-btn ) 

* Settings are stored in theme.xml *
```
- Custom JS editor
- Custom CSS editor
- File Manager ( Delete | Copy Url | Rename )
- QR Code for Articles
- Help Desk
- Share on social media

### Adding an Article
![StupidSimpleCMS Logo](https://i.ibb.co/nrLx0P4/Screenshot-11-18-2023-18-30-13.png)

### Edit or Delete Articles ( Ajax )
![StupidSimpleCMS0 Logo](https://i.ibb.co/CsHSjJh/Screenshot-11-12-2023-20-39-47.png)

### Select content to edit ( Ajax )
![StupidSimpleCMS1 Logo](https://i.ibb.co/TvmwJZW/Screenshot-11-12-2023-20-41-17.png)

### Login page
![StupidSimpleCMS1 Logo](https://i.ibb.co/fdv52JC/Screenshot-11-12-2023-20-43-03.png)

### ADA Compliant Toolset
![StupidSimpleCMS1 Logo](https://i.ibb.co/fFfx8yP/Screenshot-11-12-2023-20-56-26.png)

### Blog Designer ( Beta ) More features coming soon.
![StupidSimpleCMS1 Logo](https://i.ibb.co/VvrVjHZ/Screenshot-11-17-2023-17-59-41.png)

### File Manager
![StupidSimpleCMS1 Logo](https://i.ibb.co/pb9QsX0/Screenshot-11-18-2023-18-34-21.png)

### Custom CSS3 Editor
![StupidSimpleCMS1 Logo](https://i.ibb.co/BZmW4Rb/Screenshot-11-18-2023-18-32-01.png)

### Custom JS Editor
![StupidSimpleCMS1 Logo](https://i.ibb.co/F7KsRVk/Screenshot-11-18-2023-18-35-15.png)

### Unlimited Theme Possibilities
![StupidSimpleCMS1 Logo](https://i.ibb.co/NndgSMZ/Screenshot-11-18-2023-18-37-53.png)

### Terminal ( Beta )
![StupidSimpleCMS1 Logo](https://i.ibb.co/BBgLDgw/Screenshot-11-18-2023-21-50-19.png)

### Share articles using QR code
![StupidSimpleCMS1 Logo](https://i.ibb.co/Lr5GqdZ/Screenshot-11-21-2023-20-07-42.png)

### Contact our help desk
![StupidSimpleCMS1 Logo](https://i.ibb.co/yn6qZ88/Screenshot-11-22-2023-22-56-41.png)

### Social Sharing Buttons
![StupidSimpleCMS1 Logo](https://i.ibb.co/CWyBQ9S/Screenshot-11-23-2023-09-06-18.png)


#### Created by Randal Burger ( codelyfe.github.io )