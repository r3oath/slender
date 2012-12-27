<?php

class Slender_Setup_Task {

    /**
     * Run this task.
     * 
     * @param mixed $arguments Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function run($arguments){
        echo 'To begin, run "php artisan slender::setup:install"';
    }

    /**
     * Start the installation.
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function install(){
        $this->_spacer();
        $this->_header('Beginning Installation...');

        $this->_subheader('Creating the DB migration.');
        $this->create_migration();
        $this->_spacer();
        Laravel\CLI\Command::run(array('migrate'));
        $this->_spacer();

        $this->_subheader('Publishing Slender assets');
        $this->_spacer();
        Laravel\CLI\Command::run(array('bundle:publish'));

        $this->_spacer();
        $this->_subheader('Installation Complete!');
    }

    /**
     * Create the migration file.
     * 
     * @access private
     *
     * @return mixed Value.
     */
    private function create_migration(){
        $file = $this->path('migrations') . date('Y_m_d_His') . '_create_slender_table.php';
        $this->write_file($file, static::$migrationCode);
    }

    /**
     * Console output spacer.
     * 
     * @access private
     *
     * @return mixed Value.
     */
    private function _spacer(){
        echo PHP_EOL;
    }

    /**
     * Console output header message.
     * 
     * @param mixed $text Description.
     *
     * @access private
     *
     * @return mixed Value.
     */
    private function _header($text){
        echo '[*] ' . $text . PHP_EOL;
    }

    /**
     * Console output sub header message.
     * 
     * @param mixed $text Description.
     *
     * @access private
     *
     * @return mixed Value.
     */
    private function _subheader($text){
        echo '[-] ' . $text . PHP_EOL;
    }

    /**
     * Console output warning message. (You don't want to see these!)
     * 
     * @param mixed $text Description.
     *
     * @access private
     *
     * @return mixed Value.
     */
    private function _warning($text){
        echo '[# WARNING] ' . $text . PHP_EOL;
    }

    /**
     * Return the Laravel path to the specified folder.
     * 
     * @param string $dir Description.
     *
     * @access private
     *
     * @return mixed Value.
     */
    private function path($dir = ''){        
        return ($dir !== '') ? (path('app') . "$dir/") : path('app');
    }

    /**
     * Write a file to disk.
     * 
     * @param mixed $filePath  File path & name.
     * @param mixed $contents  Contents.
     * @param mixed $overwrite Overwrite if exists.
     *
     * @access private
     *
     * @return mixed Value.
     */
    private function write_file($filePath, $contents, $overwrite = false){
        if($overwrite === false && File::exists($filePath)){
            _warning('' . $filePath . ' already exists!');
            return;
        }

        File::mkdir(dirname($filePath));

        if(File::put($filePath, $contents) === false){
            _warning('Something went wrong writing the file ' . $filePath);
        }
    }

    /**
     * Return file contents.
     * 
     * @param mixed $filePath File path & name.
     *
     * @access private
     *
     * @return mixed Value.
     */
    private function grab_file($filePath){
        if(File::exists($filePath) === false){
            _warning('' . $filePath . ' does not exist!');
            return;
        }

        return file_get_contents($filePath);
    }

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
}