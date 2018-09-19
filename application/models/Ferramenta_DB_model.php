<?php
/**
    * 2017
    * Alterado por: Leonardo F. Rauber
    * Email: leorauber@hotmail.com - 132789@upf.br
    * Projeto de conclusão de curso
    * UPF - Ciência da Computação
*/	

class Ferramenta_DB_model extends CI_Model{
    
    function backupDB(){
        // Load the DB utility class
        $this->load->dbutil();
        
        $prefs = array(
//            'tables'        => array('table1', 'table2'),   // Array of tables to backup.
//            'ignore'        => array(),                     // List of tables to omit from the backup
            'format'        => 'txt',                         // gzip, zip, txt
            'filename'      => 'backup.sql',                  // File name - NEEDED ONLY WITH ZIP FILES
//            'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
//            'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
            'foreign_key_checks' => 'FALSE'                     // Whether output should keep foreign key checks enabled.
//            'newline'       => "\n"                         // Newline character used in backup file
        );
        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup($prefs);

        // Load the file helper and write the file to your server
        $this->load->helper('file');
        write_file('backup.sql', $backup);
        
        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('backup.sql', $backup);
    }
    
    function restoreDB($backup){
//        $this->load->dbforge();
//        if ($this->dbforge->drop_database('protegemed'))
//        {
//            echo 'Drop database sucess!';
//            if ($this->dbforge->create_database('protegemed'))
//            {
//                require('../config/user.database.php');
        
                $my_cnf = "-u{$userDb['username']} -p{$userDb['password']} -h {$userDb['hostname']} -D {$userDb['database']} < {$backup}";
                shell_exec("mysql $my_cnf");
                $date = shell_exec(date);
                echo $date;
//            }
//        }
    }
} 
?>