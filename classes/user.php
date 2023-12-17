<?php
    class user{
		public static function set_topic_by_email($email = null, $condition = null, $topic = null){
			$conn = user :: get_db_connection();
			$query = "UPDATE user SET {$topic} = {$condition} WHERE email = '{$email}';";
			$result = $conn->exec($query);
		}
		public static function add_description_user_by_email($description = null, $email = null){
			$conn = user :: get_db_connection();
			$query = "UPDATE user SET description = '{$description}' WHERE email = '{$email}';";
			$result = $conn->exec($query);
		}
        public static function add_user($username = null, $email = null, $hashedpassword = null){
			$conn = user :: get_db_connection();
			$query = "INSERT INTO user (username, email, password) VALUES ('{$username}', '{$email}', '{$hashedpassword}')";
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

		public static function update_user_image($email, $imagePath) {
			$conn = user::get_db_connection();
	
			try {
				$stmt = $conn->prepare("UPDATE user SET src = :imagePath WHERE email = :email");
				$stmt->bindParam(':imagePath', $imagePath);
				$stmt->bindParam(':email', $email);
	
				$stmt->execute();
				return true; // Assuming success
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
				return false;
			}
		}

	    public static function search_user_by_username($username = null){
			$conn = self::get_db_connection();
	
			try {
				$query = "SELECT id, username,email, description, src FROM user WHERE username LIKE :username";
				$stmt = $conn->prepare($query);
				$stmt->bindValue(':username', "%{$username}%", PDO::PARAM_STR);
				$stmt->execute();
	
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				return $results;
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
	
			return [];
		}
	    public static function get_user_by_id($id = null){
			$conn = self::get_db_connection();
			try {
				$query = "SELECT * FROM user WHERE id = :id";
				$stmt = $conn->prepare($query);
				$stmt->bindValue(':id', $id, PDO::PARAM_INT);
				$stmt->execute();

				$results = $stmt->fetch(PDO::FETCH_ASSOC);
				return $results;
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			return [];
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
