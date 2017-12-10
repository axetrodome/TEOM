<?php
class DB{

	private static $_instance = null;

	public $_pdo,
			$_query,
			$_errors = false,
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
	public function query($sql,$params[]){

	}
	public function action($table,$action,$where[]){
		$operators = ['<','>','!=','<=','>=','='];
		if(count($where) == 3){
			$field = $where[0];
			$operator = $where[1];
			$values = $where[2];

			if(in_array($operator, $operators)){
				$sql = "{$action} FROM {$table} WHERE $field $operator ?";
				return $this->query($sql,array($values))
			}
		}
		return false;
	}

}