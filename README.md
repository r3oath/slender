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

To login and manage Slender tags, you'll need an existing user system. Any user wanting to edit tags will need the *slender_admin* column in the user table to be equal to *1* (true). If you already have a users table, you can create a new migration to add this column

    $table->boolean('slender_admin')->default(0);

### Using Slender

Slender has various different content tag types. These include HTML, Text, JS (JavaScript/jQuery etc), CSS and Image.
    
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

##### Global Tags

If you'd like a tag to appear on any page and not just the page it was created on, simply add 'true' as the 3rd argument. This will ignore the page check and display the tag.

    {{ Slender::html('Global: Footer', 'Some Description', true) }}

Once tags have been placed on a page, load the page in the browser to initialize them (no content will be displayed, this is normal).

Login to the Slender Admin area by adding /slender to the end of your domain
    
    http://<your-website>/slender

Login with any user that has Slender Admin priviledges.

On the Slender Dashboard all the available tags will be displayed. Click on a tag to begin editing the associated content. To save simply click the save tag button at the bottom.

Once edited and saved tags will immediately start displaying their associated content on the appropriate pages.