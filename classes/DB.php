<?php
class DB{

	private static $_instance = null;

	public  $_pdo,
			$_query,
			$_errors = false,
			$_results,
			$_count = 0;

	public function __construct(){
		try {
			$this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'),Config::get('mysql/user'),Config::get('mysql/pass'));
			echo 'Im connected';
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	//singleton
	public static function getInstance(){
		if(!isset(self::$_instance)){
			self::$_instance = new DB();
		}
		return self::$_instance;
	}
	public function query($sql,$params = array()){
		$this->_errors = false;
		if($this->_query = $this->_pdo->prepare($sql)){
			if($params){
				$x = 1;
				foreach($params as $param){
					$this->_query->bind($x,$param);
					$x++;
				}
			}
			if($this->_query->execute()){
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}else{
				$this->_errors = true;
			}
		}
		return $this; // method chaining
	}
	public function action($table,$action,$where = array()){
		$operators = ['<','>','!=','<=','>=','='];
		if(count($where) == 3){
			$field = $where[0];
			$operator = $where[1];
			$values = $where[2];

			if(in_array($operator, $operators)){
				$sql = "{$action} FROM {$table} WHERE $field $operator ?";
				return $this->query($sql,array($values));
			}
		}
		return false;
	}
	public function insert($table,$fields = array()){
		$keys = array_keys($fields);
		$x = 1;
		$value = '';
		foreach ($fields as $field) {
			$values .= '?';
			if($x < count($fields)){
				$values .= ', ';
				$x++;
			}
		}
		$sql = "INSERT INTO {$table} (`".implode('`, `', $keys)."`) VALUES ({$values})";
		if(!$this->query($sql,$fields)->errors()){
			return true;
		}
		return false;
	}

	public function errors(){
		return $this->_errors;
	}

}
