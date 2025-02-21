<?php

class Connection{


	
	static public function connect() {
        include 'configuration.php';

        $link = new PDO("mysql:host={$config['db_host']};dbname={$config['db_name']}",
                        $config['db_user'],
                        $config['db_pass']);
        $link->exec("set names utf8");
        return $link;
    }
}

?>