<?php
    class user{
        public static function add_user($username = null, $email = null, $password = null){
			$conn = user :: get_db_connection();
			$query = "INSERT INTO user (username, email, password) VALUES ('{$username}', '{$email}', {$password})";
			$result = $conn->exec($query);
		}


        public static function get_rowcount_by_email($email = null){
			$conn = user :: get_db_connection();
			$query = "SELECT * FROM user where email = '{$email}'";
			$result = $conn->query($query);
			return $result->rowCount();
		}

        public static function get_user_by_email($email = null){
			$conn = user :: get_db_connection();
			$query = "SELECT * FROM user where email = '{$email}'";
			$result = $conn->query($query);
			return $result->fetch();
		}

        protected static function get_db_connection()
		{
			$servername = "localhost";
			$username = "root";
			$password = "";
			$database = "postpulse";
			$conn = null;

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch (PDOException $e) {
				echo "Connection failed: " . $e->getMessage();
				die;
			}
		}
    }
?>