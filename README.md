# Slender CMS

A lightweight, flexible and utterly simple content management system plugin for Laravel.

For licensing, please see the included "LICENSE".

***

## Getting Started

### Video Instructions

Check out http://www.youtube.com/watch?v=GBuhPuX2w3o

### Installing Slender

Start by cloning/downloading the Slender CMS repo into your Laravel *Bundles* folder.

    git clone https://github.com/r3oath/slender.git slender

Create a new migration using artisan

    php artisan migrate:make create_slender_table

In the `up()` function of the migration, insert the following
    
    Schema::create('slendertags', function($table){
        $table->increments('id')->unique();
        $table->string('type');
        $table->string('name');
        $table->string('page');
        $table->string('description')->nullable();
        $table->text('contents')->nullable();
        $table->string('alt')->nullable();
        $table->boolean('enabled')->default(0);
        $table->timestamps();
    });

Followed by the following in the `down()` function

    Schema::drop('slendertags');

Run the new migration using artisan
    
    php artisan migrate

We need to let Laravel know about Slender, so let's add it into the *bundles.php* file

    return array(
        'docs' => array('handles' => 'docs'),
        'slender' => array('handles' => 'slender', 'auto' => true),
    );
    

Finish by publishing Slenders assets.
    
    php artisan bundle:publish

To login and manage Slender tags, you'll need some sort of existing user system. All thats required is that any user wanting to edit tags (aka an admin/moderator) will require the *slender_admin* colum in the user table to be equal to *1* (one). If you already have a users table setup, you can create a new migration to add this colum in

    $table->boolean('slender_admin')->default(0);

### Using Slender

Slender has various different Tag types for content. These include HTML, Text, JS (JavaScript/jQuery etc), CSS and Image. Using these Tags are simple within Blade.
    
#### HTML Tags

    {{ Slender::html('Home: Main Content', 'Some Description') }}

#### TEXT Tags

    {{ Slender::text('Home: Sidebar Content', 'Some Description') }}

#### JS Tags

    {{ Slender::js('Home: Menu Actions', 'Some Description') }}

#### CSS Tags

    {{ Slender::css('Home: Menu Styling', 'Some Description') }}

#### IMAGE Tags

    {{ Slender::image('Home: Product Image', 'Some Description') }}

Note that *descriptions are optional*, so this will work too

    {{ Slender::html('Home: Main Content') }}

Once you have placed tags on your page, simply load it in the browser to activate the tags (no content will be displayed, this is normal).

You can now visit the Slender Admin area by visiting
    
    http://<your-website>.<tld>/slender

You'll be greeted with a login page. Simply login with the user that has Slender Admin priviledges (created during the installation process).

On successful login, you'll be taken to the Slender Dashboard where all the available tags will be displayed. New tags will have a + symbol next to their name, while active tags will have the tag symbol.

Simply click on a tag to begin editing the associated content. To save simply click the save tag button at the bottom.

Visit the page the tag lives on and you should now see the associated content displayed!