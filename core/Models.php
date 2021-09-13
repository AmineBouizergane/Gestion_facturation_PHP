<?php
class Models {
	var $arr;
	private $id;
	protected $pdo;
	const HOST = 'localhost';
    const DB_NAME = 'omega_db';
    const DB_USER = 'root';
    const DB_PASS = '';



	function __construct() {
			$this->pdo = new PDO ( 'mysql:dbname=' . self::DB_NAME . '; host=' . self::HOST, self::DB_USER, self::DB_PASS );
	}

	/*function connexion() {
		try {
			$this->pdo = new PDO ( 'mysql:dbname=' . self::DB_NAME . '; host=' . self::HOST, self::DB_USER, self::DB_PASS );
			return ("connexion bien fais");
		} catch (PDOException $e) {
			return ($e);
		}
	}*/

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function selectAll() {
		$this->pdo = new PDO ( 'mysql:dbname=' . self::DB_NAME . '; host=' . self::HOST, self::DB_USER, self::DB_PASS );
		$req = "select * from $this->table";
		$stat = $this->pdo->query ( $req );
		$arr_result = array ();
		foreach ( $stat->fetchAll ( PDO::FETCH_ASSOC ) as $row ) {
			$arr_result [] = $row;
		}
		return $arr_result;
	}
	public function update($data = array()){
		$this->pdo = new PDO ( 'mysql:dbname=' . self::DB_NAME . '; host=' . self::HOST, self::DB_USER, self::DB_PASS );
		$id = array();

		foreach ( $data as $key => $value ) {
			if ($key == 'id'){
				$id = $value;

			}
		}
		unset($data['id']);
		//return $id
		if (isset ( $data ['table'] ) && ! empty ( $data ['table'] )) {
			$this->table = $data ['table'];
     	}
		$sql = "UPDATE $this->table SET ";

		foreach ( $data as $key => $value ) {
				$sql .= " $key = :$key,";
		}

		$sql = substr ( $sql, 0, - 1 );
		$sql .= " WHERE ".$id['n']." = '" . $id['d']."'";
		$pdo_statement = $this->pdo->prepare ( $sql );

		foreach ( $data as $key => $value ) {
			$pdo_statement->bindValue ( ":$key", $value );
		}
		//return $sql;
		//$this->pdo->lastInsertId();
		//$pdo_statement = $this->pdo->prepare ( $sql );
		return $pdo_statement->execute ();
		//return $this->pdo->errorInfo();

	}


	public function update_($data = array()) {
		$this->pdo = new PDO ( 'mysql:dbname=' . self::DB_NAME . '; host=' . self::HOST, self::DB_USER, self::DB_PASS );
		$id = array ();

		foreach ( $data as $key => $value ) {
			if ($key == 'id') {
				$id = $value;
			}
			if($key == 'id1'){
                $id1 = $value;
			}
		}
		unset ( $data ['id'] );
	    if(isset($data ['id1'])){
	    	unset($data['id1']);
	    }
		// return $id
		if (isset ( $data ['table'] ) && ! empty ( $data ['table'] )) {
			$this->table = $data ['table'];
		}
		$sql = "UPDATE $this->table SET ";

		foreach ( $data as $key => $value ) {
			$sql .= " $key = :$key,";
		}

		$sql = substr ( $sql, 0, - 1 );
		$sql .= " WHERE " . $id ['n'] . " = '" . $id ['d'] . "'";
		if(isset($id1)){
			$sql .= " AND " . $id1 ['n'] . " = '" . $id1 ['d'] . "'";
		}
		$pdo_statement = $this->pdo->prepare ( $sql );

		foreach ( $data as $key => $value ) {
			$pdo_statement->bindValue ( ":$key", $value );
		}
		//return $sql;
		// $this->pdo->lastInsertId();
		// $pdo_statement = $this->pdo->prepare ( $sql );
		 return $pdo_statement->execute ();
		//return $this->pdo->errorInfo();
	}



	public function save_($data = array()) {
		$this->pdo = new PDO ( 'mysql:dbname=' . self::DB_NAME . '; host=' . self::HOST, self::DB_USER, self::DB_PASS );
		$pdo_statement = new PDOStatement ();
		$id = '';
		try {
			$id = '';
			foreach ( $data as $key => $val) {
				if (preg_match ( '#_id_#i', $key )) {
					$id = substr ( $key, 0, - 1 );
				}
			}

			if ($id !== '') {

				if (isset ( $data ['table'] ) && ! empty ( $data ['table'] )) {
					$this->table = $data ['table'];
				}
				$sql = "UPDATE $this->table SET ";

				foreach ( $data as $key => $value ) {
					if ($key != $id . '_') {
						$sql .= " $key = :$key,";
					}
				}

				$sql = substr ( $sql, 0, - 1 );
				$sql .= " WHERE $id = :" . $id ;
				$pdo_statement = $this->pdo->prepare ( $sql );

				foreach ( $data as $key => $value ) {
					$pdo_statement->bindValue ( ":$key", $value );
				}
			} else {
				$val = '';
				$sql = "INSERT INTO $this->table (";
				unset ( $data ['id'] );

				foreach ( $data as $key => $value ) {
					$sql .= "$key, ";
					$val .= ":$key, ";
				}

				$sql = substr ( $sql, 0, - 2 ) . ") VALUES ( " . substr ( $val, 0, - 2 ) . " );";
				$pdo_statement = $this->pdo->prepare ( $sql );

				foreach ( $data as $key => $value ) {
					$pdo_statement->bindValue ( ":$key", $value );
				}
			}

			//return $sql;
			$pdo_statement->execute ();
			return $this->pdo->lastInsertId();
		} catch ( PDOException $e ) {
			trigger_error ( $e->getMessage (), E_USER_ERROR );
		}
	}


	public function save($data = array()) {
		$this->pdo = new PDO ( 'mysql:dbname=' . self::DB_NAME . '; host=' . self::HOST, self::DB_USER, self::DB_PASS );
		$pdo_statement = new PDOStatement ();
		$id = '';
		try {
			$id = '';
			foreach ( $data as $key => $val) {
				if (preg_match ( '#_id_#i', $key )) {
					$id = substr ( $key, 0, - 1 );
				}
			}

			if ($id !== '') {

				if (isset ( $data ['table'] ) && ! empty ( $data ['table'] )) {
					$this->table = $data ['table'];
				}
				$sql = "UPDATE $this->table SET ";

				foreach ( $data as $key => $value ) {
					if ($key != $id . '_') {
						$sql .= " $key = :$key,";
					}
				}

				$sql = substr ( $sql, 0, - 1 );
				$sql .= " WHERE $id = :" . $id ;
				$pdo_statement = $this->pdo->prepare ( $sql );

				foreach ( $data as $key => $value ) {
					$pdo_statement->bindValue ( ":$key", $value );
				}
			} else {
				$val = '';
				$sql = "INSERT INTO $this->table (";
				unset ( $data ['id'] );

				foreach ( $data as $key => $value ) {
					$sql .= "$key, ";
					$val .= ":$key, ";
				}

				$sql = substr ( $sql, 0, - 2 ) . ") VALUES ( " . substr ( $val, 0, - 2 ) . " );";
				$pdo_statement = $this->pdo->prepare ( $sql );

				foreach ( $data as $key => $value ) {
					$pdo_statement->bindValue ( ":$key", $value );
				}
			}
			$this->pdo->lastInsertId();
			//return $sql;
			return $pdo_statement->execute ();
		} catch ( PDOException $e ) {
			trigger_error ( $e->getMessage (), E_USER_ERROR );
		}
	}
	public function increment($data = array()) {
		$condition = '1=1';
		$column = '';
		$update = '';
		for($i = 0; $i < count ( $data ['col'] ); $i ++) {
			$column = $data ['col'] [$i];
			$newValue = $column . ' + ' . $data ['step'] [$i];
			$update .= "$column = $newValue, ";
		}

		$update = substr ( $update, 0, - 2 );

		$tabl = $this->table;

		if (isset ( $data ['table'] )) {
			$tabl = $data ['table'];
		}
		if (isset ( $data ['condition'] ) && ! empty ( $data ['condition'] )) {
			$condition = '';
			foreach ( $data ['condition'] as $value ) {
				$condition .= $value . " and ";
			}
			$condition = substr ( $condition, 0, - 5 );
		}

		$sql = "UPDATE $tabl SET $update WHERE $condition";

		$pdo_statement = $this->pdo->prepare ( $sql );

		foreach ( $data ['params'] as $key => $value ) {
			$pdo_statement->bindValue ( $key, $value );
			echo "$key => $value<br />";
		}

		echo $sql;
		$pdo_statement->execute ();
	}
	public function find($data = array()) {
		$this->pdo = new PDO ( 'mysql:dbname=' . self::DB_NAME . '; host=' . self::HOST, self::DB_USER, self::DB_PASS );
		$condition = "1=1";
		$fields = "*";
		$limit = "";
		$order = "1 DESC";
		extract ( $data );

		if (isset ( $data ['limit'] )) {
			$limit = $data ['limit'];
		}
		if (isset ( $data ['fields'] )) {
			$fields = $data ['fields'];
		}
		if (isset ( $data ['condition'] )) {
			$condition = $data ['condition'];
		}
		if (isset ( $data ['order'] )) {
			$order = $data ['order'];
		}
		$sql = "SELECT $fields FROM $this->table WHERE $condition ORDER BY $order $limit;";

		//return $sql;

		$result = $this->pdo->prepare($sql);
		$tbl = array ();

		foreach ( $data ['params'] as $key => $value ) {
			$result->bindValue ( $key, $value );
		}

		$result->execute();

		foreach ( $result->fetchAll ( PDO::FETCH_ASSOC ) as $value ) {
			$tbl [] = $value;
		}

		return $tbl;

		//return $result ;
	}
	public function preparedQuery($data = array()) {
		$condition = "1=1";
		$fields = "*";
		$table = "";
		$cardinalites = "";
		$limit = "";
		$order = "1 DESC";
		// extract ( $data );

		// fields
		if (isset ( $data ['fields'] )) {
			$fields = "";
			foreach ( $data ['fields'] as $value ) {
				$fields .= "$value, ";
			}
			$fields = substr ( $fields, 0, - 2 );
		}

		// tables
		if (isset ( $data ['tables'] )) {
			foreach ( $data ['tables'] as $value ) {
				$table .= "$value, ";
			}
			$table = substr ( $table, 0, - 2 );
		}

		// cardinalite
		if (count ( $data ['tables'] ) > 1) {
			foreach ( $data ['cardinalite'] as $key => $value ) {
				$cardinalites .= $key . ' = ' . $value . ' and ';
			}
			$cardinalites = substr ( $cardinalites, 0, - 5 );
		}

		// condition
		if (isset ( $data ['condition'] )) {
			$condition = "AND ";
			foreach ( $data ['condition'] as $key => $value ) {
				if (gettype ( $value ) == 'integer') {
					$condition .= $key . " = :$key and ";
				} else {
					$condition .= $key . " like :$key and ";
				}
			}
		}
		$condition = substr ( $condition, 0, - 5 );

		// limit
		if (isset ( $data ['limit'] )) {
			$limit = $data ['limit'];
		}

		// order
		if (isset ( $data ['order'] )) {
			$order = "";
			foreach ( $data ['order'] as $key => $value ) {
				$order .= "$key $value, ";
			}
			$order = substr ( $order, 0, - 2 );
		}
		$sql = "SELECT $fields FROM $table WHERE $cardinalites $condition ORDER BY $order $limit;";

		$result = $this->pdo->prepare ( $sql );
		if (isset ( $data ['condition'] )) {
			foreach ( $data ['condition'] as $key => $value ) {
				$result->bindValue ( $key, $value );
			}
		}

		$result->execute ();

		$tbl = array ();
		foreach ( $result->fetchAll ( PDO::FETCH_ASSOC ) as $value ) {
			$tbl [] = $value;
		}

		return $tbl;
	}
	public function delete($list_id = array()) {
		$this->pdo = new PDO ( 'mysql:dbname=' . self::DB_NAME . '; host=' . self::HOST, self::DB_USER, self::DB_PASS );
		try {
			foreach ( $list_id as $key => $value ) {
				if ($value != 0) {
					$sql = "DELETE FROM $this->table where $key = $value;";
					$result = $this->pdo->prepare ( $sql );
				}
				//return $sql;
				return $result->execute ();
			}
		} catch ( PDOException $e ) {
			trigger_error ( $e->getMessage (), E_USER_ERROR );
		}
	}
   /****************************** function jalil ********************************************************/
     /*public function countligne() {
       $sql_ = "SELECT COUNT(*) from this->table"
       $res = $this->pdo->prepare($sql_);
       $res->execute();
       foreach ( $res->fetchAll ( PDO::FETCH_ASSOC ) as $row ) {
			$arr_result [] = $row;
		}
		return $arr_result;
     }*/

      public function affichparlim ($limit,$id_li){
       $sql = "SELECT * FROM  $this->table WHERE `list_id`='".$id_li."' LIMIT 0 ,".$limit;
       $arr_result = array();
       $stat = $this->pdo->prepare($sql);
       $stat->execute();
       foreach ( $stat->fetchAll ( PDO::FETCH_ASSOC ) as $row ) {
			$arr_result [] = $row;
		}
		$arry_retrn  = array('donnee' =>  $arr_result,'fin' => $limit );
		return $arry_retrn;
      }


   /******************************************************************************************************/

	function mail_send($arr) {
		if (! isset ( $arr ['to_email'], $arr ['from_email'], $arr ['subject'] )) {
			throw new HelperException ( 'mail(); not all parameters provided.' );
		}

		/*if (strtoupper ( substr ( PHP_OS, 0, 3 ) == 'WIN' ))
			$eol = "\r\n";
		elseif (strtoupper ( substr ( PHP_OS, 0, 3 ) == 'MAC' ))
			$eol = "\r";
		else*/
			$eol = "\n";

		$mime_boundary_1 = md5 ( time () );
		$mime_boundary_2 = "1_" . $mime_boundary_1;

		$to = empty ( $arr ['to_name'] ) ? $arr ['to_email'] : '"' . mb_encode_mimeheader ( $arr ['to_name'] ) . '" <' . $arr ['to_email'] . '>';
		$from = empty ( $arr ['from_name'] ) ? $arr ['from_email'] : '"' . mb_encode_mimeheader ( $arr ['from_name'] ) . '" <' . $arr ['from_email'] . '>';

		$msg .= "--{$mime_boundary_1}$eol";
		$msg .= "	boundary=\"{$mime_boundary_2}\"" . $eol . $eol;
		$msg .= quoted_printable_encode ( $arr ['campagne'] );
		$msg .= "--" . $mime_boundary_1 . "--" . $eol . $eol;

		$headers = array (
				'MIME-Version: 1.0',
				'Content-Type: text/html; charset="UTF-8";',
				'Content-Transfer-Encoding: quoted-printable',
				'Date: ' . date ( 'r', $_SERVER ['REQUEST_TIME'] ),
				'Message-ID: <' . $_SERVER ['REQUEST_TIME'] . md5 ( $_SERVER ['REQUEST_TIME'] ) . '@em4u1.com>',
				'From: ' . $from,
				'Reply-To: ' . $from,
				'Return-Path: ' . $from,
				'X-Mailer: PHP v' . phpversion (),
				'X-Originating-IP: ' . $_SERVER ['SERVER_ADDR']
		);



		return mail ( $to, '=?UTF-8?B?' . base64_encode ( html_entity_decode($arr ['subject']) ) . '?=', $msg, implode ( "$eol", $headers ) );
	}

	public function upload_image (){

		if( isset($_POST['upload']) ) // si formulaire soumis
		{
			$content_dir = 'upload/'; // dossier o� sera d�plac� le fichier

			$tmp_file = $_FILES['fichier']['tmp_name'];

			if( !is_uploaded_file($tmp_file) )
			{
				exit("Le fichier est introuvable");
			}

			// on v�rifie maintenant l'extension
			$type_file = $_FILES['fichier']['type'];

			if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') )
			{
				exit("Le fichier n'est pas une image");
			}

			// on copie le fichier dans le dossier de destination
			$name_file = $_FILES['fichier']['name'];

			if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
			{
				exit("Impossible de copier le fichier dans $content_dir");
			}

			echo "Le fichier a bien �t� upload�";
		}


	}

    function createid ($userid, $vlue, $tbl){
    	$this->table = $tbl;
    	$arrydata = array (
    			'condition' => ' `ID_CMP`= :id_cmp ',
    			'fields' => 'MAX(ID_STATU)',
    			'params' => array (
    					':id_cmp' => $userid
    			)
    	);
    	$nbr = $this->find ( $arrydata );
    	$nbr = explode ( '_', $nbr [0]['MAX(ID_STATU)'] );
    	$nbr = $nbr['2'] + 1;
    	$id = $userid.'_'.$vlue.'_'.$nbr;
    	return $id;
    }

    /*function save_action_journal($user ;$action,$table,$id_data){
		$this->table = "journal";
		$data['id_emp'] = $user;
		$data['action'] = $action;
		$data['table'] = $table;
		$data['id_data'] = $id_data;
		$data['date_action'] = date("Y-m-d G:i:s");
		//return $data;
		return $this->save($data);
	}*/


}
class HelperException extends Exception {
	function HelperException($msg) {
		echo $msg;
	}
}
?>
