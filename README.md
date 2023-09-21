# WordPress Dev Starter Theme
This theme was made from the Twenty Twenty official WP theme by the WordPress team. I implemented it to use it as a starter theme to my own projects. It's meant to be a slim theme for developers with the most relevant features present in most sites. Feel free to use it, modified, suggest changes or help improving it.

## Quick-start
- Define basic settings on the `functions.php`
- Run `gulp watch` on the theme root folder. 
- Define layout settings on `/scss/partials/_variables.scss`.

## Features
- CSS-only responsive menu.
- `gulpfile.js` configured to generate CSS files from SCSS and to minify both CSS and JS files.
- Production minified files.
- Basic [JavaScript starter template](https://gist.github.com/leomuniz/6da03e6a173a2a6f14d2b63eadf2bc9d) for WordPress with jQuery.
- Custom basic theme settings on functions.php (hide customizer, hide theme editor...).
- Basic SCSS variables to customize the layout.
- SVG Icons class (inherited from Twenty Twenty).

## CSS-only responsive menu
The responsive menu is made with only CSS. It's a pretty basic, but fully functional menu. To work properly on the mobile, a custom Walker adds `<label>` and `<checkbox>` tags that trigger the click events on the mobile. If you need more fancy effects on the trigger buttons, like animations to change their icons, you might implement them using JavaScript.

The main menu on the header is the `Primary Menu` that should be edited on the `Appareance > Menus`. There is no "auto-menu" adding added pages to WordPress. If you need more menus, you can just add them on the `/inc/menus.php`.

## GULP implementation
A `gulpfile.js` is included to generate the CSS files from the SCSS, minify both the CSS and the JS files and create the SCSS maps. To use it, just run `gulp watch` on the terminal on the theme root and then edit your files.

All the JS files created on the `/assets/js/` folder will be minified. And all the SCSS files, but the ones in the `partials` folder starting with underscore (eg _partial.scss) will generate a correspondent file in the `/assets/css/` folder and its minified version.

## Production minified files.
The minified files created by the Gulp process are enqueued on a production site when the `wp_get_environment_type()` does not return a dev environment.

To enqueue the original files, you can set you environment to development, by adding this constant definition on the `wp-config.php` file:
```
define( 'WP_ENVIRONMENT_TYPE', 'development' );
```
If you need customize the way the files are enqueued, just edit the `/inc/enqueues.php`. 

## Custom basic theme settings on functions.php
Go to functions.php and define some basic settings of your theme:
- Classic Editor (boolean) - currently now working 
- Hide Customizer (boolean)
- Hide Theme Editor (boolean)
- Display the site description below the title (boolean)
- Define the custom post thumbnail size.
- Define the custom logo size

## Basic SCSS variables to customize the layout.
In the `/scss/partials/_variables.scss` there are some important layout settings, like the site width, the background color, the primary and secondary color.
   
## Roadmap
- Enable classic editor (not working)
- Add more basic layout settings on `/scss/partials/_variables.scss`
- Fix the Gutenberg WYSIWYG preview 
- Add a basic Gutenberg react block as a template block


##  Alternatives
If this theme doesn't fit your needs, you might try some alternatives:

- https://underscores.me/
- https://wordpress.org/themes/generic/
- https://wordpress.org/themes/wp-bootstrap-starter/ (Underscores + Bootstrap 4 + FontAwesome)
- https://wordpress.org/themes/understrap/ (Underscores + Bootstrap)
- https://wordpress.org/themes/catch-starter/
- https://wordpress.org/themes/air-light/
- https://roots.io/sage/ (Tailwind CSS and Laravel Blade)
- https://quarktheme.com/
