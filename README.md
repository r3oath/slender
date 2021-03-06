# Slender CMS

A lightweight, flexible and utterly simple content management system plugin for Laravel.

For licensing, please see the included "LICENSE".

***

![Slender](http://r3oath.com/slender2.jpg)

## Getting Started

### Installing Slender

Installation is dead simple... it's 3 steps!

Clone the Slender Repo into your Laravel Bundles folder

    git clone https://github.com/r3oath/slender.git slender

Let Laravel know about Slender by adding one line in the *bundles.php* file in the *application/* directory.

```php
return array(
    'docs' => array('handles' => 'docs'),
    // Add this line below.
    'slender' => array('handles' => 'slender', 'auto' => true),
);
```

Open up a console window and run

    php artisan slender::setup:install

The console should output something similar too...

    [*] Beginning Installation...
    [-] Creating the DB migration.

        Migrated: application/2012_12_27_124224_create_slender_table

    [-] Publishing Slender assets

    Assets published for bundle [docs].
    Assets published for bundle [slender].

    [-] Installation Complete!

You're now ready to start using Slender!

### Managing Slender Users

To login and manage Slender tags, you'll need an existing user system. Your users table will require one additional field, this being

```php
$table->boolean('slender_admin')->default(0);
```

Any user who has *slender_admin* equal to 1 (true) will be able to access the Slender dashboard.

![Slender](http://r3oath.com/slender1.jpg)

### Placing Slender Tags

Slender has various different content tag types. These include HTML, Text, JS (JavaScript/jQuery etc), CSS and Image. Place these tags in any spot you wish to pull in dynamic content.
    
#### HTML Tags

```php
{{ Slender::html('Home: Main Content', 'Some Description') }}
```

#### TEXT Tags

```php
{{ Slender::text('Home: Sidebar Content', 'Some Description') }}
```

#### JS Tags

```php
{{ Slender::js('Home: Menu Actions', 'Some Description') }}
```

#### CSS Tags

```php
{{ Slender::css('Home: Menu Styling', 'Some Description') }}
```

#### IMAGE Tags

```php
{{ Slender::image('Home: Product Image', 'Some Description') }}
```

Note that *descriptions are optional*, this is acceptable

```php
{{ Slender::html('Home: Main Content') }}
```

##### Global Tags

If you'd like a tag to appear on multiple pages and not just the page it was created on, simply set the 3rd tag argument as 'true'. This sets the tag as global.

```php
{{ Slender::html('Global: Footer', 'Some Description', true) }}
```

Once tags have been placed on a page, load the page in the browser to initialize them, no content will be displayed, this is normal.

***

### Managing Tags

![Slender](http://r3oath.com/slender3.jpg)

Login to the Slender Admin area by adding /slender to the end of your domain.
    
    http://<your-website>/slender

All initialized tags will be displayed on the dashboard. Click on a tag to begin editing the associated content. Click save to activate the tag. Saved tags will immediately start displaying their associated content.