<?php

class Slender_Setup_Task {

    public function run($arguments){
        echo 'To begin, run "php artisan slender::setup:install"';
    }

    public function install(){
        $this->_spacer();
        $this->_header('Beginning Installation...');

        $this->_subheader('Creating the table migration.');
        $this->create_migration();
        $this->_spacer();
        Laravel\CLI\Command::run(array('migrate'));
        $this->_spacer();

        $this->_subheader('Publishing Slender public assets');
        $this->_spacer();
        Laravel\CLI\Command::run(array('bundle:publish'));

        $this->_spacer();
        $this->_subheader('Installation Complete!');
    }

    private function create_migration(){
        $file = $this->path('migrations') . date('Y_m_d_His') . '_create_slender_table.php';
        $this->write_file($file, static::$migrationCode);
    }

    private function _spacer(){
        echo PHP_EOL;
    }

    private function _header($text){
        echo ' > ' . $text . PHP_EOL;
    }

    private function _subheader($text){
        echo '   > ' . $text . PHP_EOL;
    }

    private function path($dir = ''){        
        return ($dir !== '') ? (path('app') . "$dir/") : path('app');
    }

    private function write_file($filePath, $contents, $ow = false){
        if($ow === false && File::exists($filePath)){
            _subheader('# Warning, ' . $filePath . ' already exists!');
            return;
        }

        File::mkdir(dirname($filePath));

        if(File::put($filePath, $contents) === false){
            _subheader('# Warning, something went wrong writing the file ' . PHP_EOL . $filePath);
        }
    }

    private function grab_file($filePath){
        if(File::exists($filePath) === false){
            _subheader('# Warning, ' . $filePath . ' does not exist');
            return;
        }

        return file_get_contents($filePath);
    }

// ------------------------------------------------------------------------------
// Migration Code.
// ------------------------------------------------------------------------------
private static $migrationCode = <<<'EOT'
    <?php
    class Create_Slender_Table {
        public function up() {
            Schema::create('slendertags', function($table){
                $table->increments('id')->unique();
                $table->string('type');
                $table->string('name');
                $table->string('page');
                $table->string('description')->nullable();
                $table->text('contents')->nullable();
                $table->string('alt')->nullable();
                $table->string('stream_hash')->nullable();
                $table->integer('stream_id')->default(0);
                $table->boolean('enabled')->default(0);
                $table->timestamps();
            });
        }
        public function down(){
            Schema::drop('slendertags');
        }
    }
EOT;
// ------------------------------------------------------------------------------
}