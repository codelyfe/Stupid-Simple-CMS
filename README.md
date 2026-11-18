# Stupid Simple CMS ( Blogger )
 Stupid Simple CMS - Created to be simple. Blog posting CMS.

### Last Updated: (11-18-2026)

## Version 1.3.0

```
PHP: 8.4 (8.0+ still runs)
Database: SQLite (data/cms.sqlite). No MySQL.
```

![StupidSimpleCMS Logo](https://i.ibb.co/HpKWcSK/Screenshot-11-12-2023-20-34-08.png)

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://github.com/codelyfe/Stupid-Simple-CMS)


   ----------

Watch Demo on YouTube: [Stupid Simple CMS](https://youtu.be/BGoWF6s8YxU)   
Donate: [Support The Developer](https://www.paypal.me/codelyfe) 


## Installing Stupid Simple CMS
Download and extract all of the files to your web server. It can live at the domain root or in a subfolder such as `/stupid-simple-cms/`. The blog URL is detected from that path.

The web server needs permission to create and write `data/cms.sqlite`.

Docker:

```
docker build -t stupid-simple-cms .
docker run -p 8080:80 stupid-simple-cms
```

The image is `php:8.4-apache` with SQLite, OPcache, and compressed static files.

### First admin

There is no built-in username or password. Open **Submit an Article**. If no admin exists yet, that page asks you to create one. The password is stored with `password_hash` in SQLite. Later visits use the same page as the login.

### Site settings

Title, copyright, greeting, and meta fields are edited in Admin → Settings and saved in SQLite. The blog URL field is read-only and filled in automatically.

Existing `admin/site-settings.xml`, `theme.xml`, and `blog-posts/*.json` files are imported into SQLite the first time a page loads.

### Predifined classes to style blog elements

```
blog-title

blog-cat

blog-clipboard

blog-fb

blog-trello

blog-content

```

### Configure Site Settings

- Text | text-centent/english.php - Text Variables

- Style | settings/global.php - Global Language Select

- Style | layout/header.php - Global Header for Users

- Style | style/header-admin.php - Global Header for Admins

### Setting up users

Create the admin from **Submit an Article** the first time. Do not edit a password array in `login.php`.

### Updating

Keep `data/cms.sqlite` and the `file-manager` uploads when you replace the code. Those hold posts, settings, the theme, the admin login, and saved custom CSS/JS.

### Features

- Public blog with a centered card layout, search, and share buttons
- Article pages that stay centered and are not covered by the background overlay
- Admin bar: Write, Articles, Settings, Design, Files, View blog, Log out
- First-run admin account, password hashed in SQLite
- Blog URL detected for the domain root or a subfolder
- Posts, site settings, and theme colors stored in SQLite
- Custom CSS and JS saved in SQLite and written back to `css/custom.css` and `js/custom.js`
- ADA Compliant Tool
- Live Ajax editing on the admin side
- Zoom in on an image
- Delete articles, with a confirm step
- Simple blog designer (font, background, article, and button colors)
- File manager (upload, copy URL, rename, delete) without the faded overlay
- Help desk
- Meta description and image
- Docker image on PHP 8.4

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

### Terminal ( Beta ) ( Removed till repaired )
![StupidSimpleCMS1 Logo](https://i.ibb.co/BBgLDgw/Screenshot-11-18-2023-21-50-19.png)

### Share articles using QR code
![StupidSimpleCMS1 Logo](https://i.ibb.co/Lr5GqdZ/Screenshot-11-21-2023-20-07-42.png)

### Contact our help desk
![StupidSimpleCMS1 Logo](https://i.ibb.co/yn6qZ88/Screenshot-11-22-2023-22-56-41.png)

### Social Sharing Buttons
![StupidSimpleCMS1 Logo](https://i.ibb.co/CWyBQ9S/Screenshot-11-23-2023-09-06-18.png)

### NEW: Theme Change
![StupidSimpleCMS1 Logo](https://i.ibb.co/G7YvkJy/Screenshot-11-23-2023-21-28-28.png)


#### Created by Randal Burger ( codelyfe.github.io )