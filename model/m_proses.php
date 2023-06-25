<?php
    class Db_table{
        protected $tb_user = 'user';
        protected $tb_book = 'tb_book';
        protected $tb_stock_book = 'tb_stock_book';
        protected $tb_inspeksi_kapal = 'tb_transaction';
                      
		protected $sql_select_distinct = "SELECT DISTINCT ";
		protected $sql_select = "SELECT * FROM ";
		protected $sql_insert = "INSERT INTO ";
		protected $sql_update = "UPDATE ";
		protected $sql_delete = "DELETE FROM ";
		protected $sql_select_count = "SELECT COUNT"; 
        protected $sql_select_sum = "SELECT SUM";    
    }

    class Proses_sql extends Db_table{
        private $mysqli;
        
        function __construct($conn){
            $this->mysqli = $conn;
        }

        public function login(
            $username = null,
            $pasword = null){
            if ($username != null && $pasword != null) {
                $table = $this->tb_user;
                $select = $this->sql_select;                
                $sql = $select;	
                $sql.= $table;
                $sql.= " WHERE username = ? AND pasword = ?";
                $db = $this->mysqli->conf;
                $query = $db->prepare($sql) or die($db->error);
                $query->bind_param("ss",$username,$pasword); 
                if ($query->execute()) {
                    $result = $query->get_result();
                }                           
            }		
            return @$result;
        }     
// Tabel User
        public function data_user($id_user = null, $nama = null){
            $db = $this->mysqli->conf;
            $table = $this->tb_user;
            $select = $this->sql_select;
            $sql= $select;
            $sql.= $table;
            if (@$id_user != null || @$id_user != "") {
                $sql.= " WHERE id_user = '$id_user' ";
            }elseif (@$name != null || @$name != "") {
                $sql.= " WHERE name = '$name' ";
            }else {
                $sql.= " ORDER BY name ASC";
            }
            $query = $db->query($sql) or die($db->error);
            return $query;
        }

        public function add_user(
            $id_user = null,
            $name = null,
            $username = null,
            $password = null,
            $address = null,
            $level = null,
            $email = null,
            $no_telp = null,
            $token = null){
    
            $db = $this->mysqli->conf;
            $table = $this->tb_user;
            $insert = $this->sql_insert;
            $sql = $insert;
            $sql.= $table;
            $sql.= " SET 
            id_user = '',
            name = '$name',
            username = '$username',
            password = '$password',
            address = '$address',
            level = '$level',
            email = '$email',
            no_telp = '$no_telp',
            token = '$token'
            ";		
            
            $query = $db->query($sql) or die($db->error);
            return $query;
        }  

        public function edit_user(
            $id_user = null,
            $name = null,
            $username = null,
            $password = null,
            $address = null,
            $level = null,
            $email = null,
            $no_telp = null,
            $token = null){
    
            $db = $this->mysqli->conf;
            $table = $this->tb_user;
            $update = $this->sql_update;
            $sql = $update;
            $sql.= $table;
            $sql.= " SET 
            name = '$name',
            username = '$username',
            password = '$password',
            address = '$address',
            level = '$level',
            email = '$email',
            no_telp = '$no_telp',
            token = '$token'
            WHERE id_user = '$id_user'
            ";		
            
            $query = $db->query($sql) or die($db->error);
            return $query;
        }  

        public function delete_user(
            $id_user = null,
            $name = null,
            $username = null,
            $password = null,
            $address = null,
            $level = null,
            $email = null,
            $no_telp = null,
            $token = null){
    
            $db = $this->mysqli->conf;
            $table = $this->tb_user;
            $delete = $this->sql_delete;
            $sql = $delete;
            $sql.= $table;
            $sql.= " WHERE id_user = '$id_user'
            ";		
            
            $query = $db->query($sql) or die($db->error);
            return $query;
        }

        function __destruct()
        {
            $db = $this->mysqli->conf;
            $db = $db->close();
        }
    }
?>