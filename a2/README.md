# Pets Victoria Website

This repository contains the code for the Pets Victoria website.

[Visit the site here](http://titan.csit.rmit.edu.au/~s3955172/wp/)
Loading 50% I not sure what's causing the issue. It was working fine on my laptop, but I'm experiencing problems on my PC. There's an error, but I haven't been able to pinpoint where it's coming from.

## Structure

- **index.php**: Home page
- **pets.php**: List of pets available for adoption (dynamically generated from the database)
- **add.php**: Form to add new pets (data is stored in the database, images are uploaded)
- **gallery.php**: Gallery of pet images (dynamically generated from the database)
- **details.php**: Page that displays detailed information about each pet (accessed by clicking on a pet in the gallery or pets list)

### Includes
- **db_connect.inc**: Database connection configuration
- **header.inc**: Header section with navigation, included on all pages

### CSS
- **style.css**: Common stylesheet for the entire website

### JavaScript
- **scripts.js**: JavaScript for dropdown menu and other dynamic behaviors

### Images
- **images/**: Directory containing uploaded pet images and other assets (like logos, favicon, etc.)

## Licensing

All images used are from Adobe Stock and used under the RMIT Education License.
