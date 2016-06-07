<?php
//include_once('main.php');

class ARModel
{
	const BELONGS_TO = 1;
	const HAS_MANY = 2;
	const HAS_ONE = 3;
	const MANY_MANY = 4;

	public static $db = null;
	protected static $_models = array();

	private $_attributes=array();
	private $joins = array();
	private $filters = array();

	public static function model($className=__CLASS__)
	{
		if(isset(self::$_models[$className]))
			return self::$_models[$className];
		else
		{
			$model=self::$_models[$className]=new $className(null);
			return $model;
		}
	}

	public function getDbConnection()
	{
		$config = $_SESSION['config'];
		if(self::$db!==null)
			return self::$db;
		else
		{
			$dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['databaseName']}";
			self::$db = new PDO($dsn, $config['db']['user'], $config['db']['password']);
			self::$db->exec('SET NAMES utf8');
			return self::$db;
		}
	}

	public function join($tablename, $key_left, $key_right) {
		$this->joins[$tablename] = $this->tableName() . ".$key_left=$tablename.$key_right";
		return $this;
	}

	public function find_by_pk($pk) {
		$data = $this->_find("{$this->getPK()}=:id", array(':id'=>$pk));
		if(!empty($data))
			$this->_attributes = $data[0]->_attributes;
		return $this;
	}

	public function find_all($start=0, $limit=0) {
		return $this->_find_all("", "", $start, $limit);
	}
	
	protected function _find_all($condition="", $params="", $start=0, $limit=0) {
		return $this->_find($condition, $params, $start, $limit);
	}
	
	public function find($condition="", $params="") {
		$data = $this->_find($condition, $params);
		if(!empty($data)) {
			$this->_attributes = $data[0]->_attributes;
			return $this;
		} else
			$this->_attributes = array();
		return null;
	}

	private function _find($condition="", $params="", $start=0, $limit=0) {
		$order = "ORDER BY {$this->getPK()} desc";
		$text_limit = $limit==0 ? "" : "LIMIT $start $limit";
		$join = "";
		foreach($this->joins as $table=>$condition) {
			$join .= "JOIN $table ON $condition";
		}
		if(empty($condition))
			$result = $this->getDbConnection()->prepare("select * from {$this->tableName()} $join $text_limit;");
		else
			$result = $this->getDbConnection()->prepare("select * from {$this->tableName()} $join where $condition $text_limit;");
		if(empty($params))
			$result->execute();
		else
			$result->execute($params);
		$items = $result->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_class($this));
		return $items;
	}

	public function save() {
		$fields = implode(", ", array_keys($this->_attributes));
		$keys = array_map(function ($x) {return ":$x";}, array_keys($this->_attributes));
		$values = implode(",",$keys);
		$result = $this->getDbConnection()->prepare("insert into {$this->tableName()}($fields) values($values);");
		$result->execute(array_combine ($keys, array_values($this->_attributes)));

		$pk = $this->getDbConnection()->lastInsertId();
		return $pk;
	}

	public function update(){
		$rules = $this->rules();
		if(isset($rules['update']))
			$fields = $rules['update'];
		else
			return;

		$object = $this;
		$field_list = array_map(function ($x) {return "$x=:$x";}, $fields);
		$values = implode(",",$field_list);
		$result = $this->getDbConnection()->prepare("update {$this->tableName()} set {$values} where {$this->getPK()}=:id;");
		$keys = array_map(function ($x) {return ":$x";}, $fields);
		$data = array_combine ($keys, array_values(array_map(function ($x) use($object) {return $object->$x;}, $fields)));
		$data[':id'] = $this->{$this->getPK()};
		$result->execute($data);
	}

	public function delete() {
		$result = $this->getDbConnection()->prepare("delete from {$this->tableName()} where {$this->getPK()} = :pk;");
		$result->execute(
			array(':pk'=>$this->{$this->getPK()})
		);
	}

	public function rules() {
		return array();
	}

	protected function getPK() {
		return 'id';
	}

	private function getPKValue() {
		return $this->{$this->getPK()};
	}

	public function relations() {
		return array();
	}

	public function tableName()
	{
		return get_class($this);
	}

	public function attributeLabels() {
		return array();
	}

	public function __get($name) {
		if(isset($this->_attributes[$name])) {
			return $this->_attributes[$name];
		}
		if(isset($this->relations()[$name])) {
			list($type, $modelname, $tablename, $keys) = $this->relations()[$name];
			if($type == self::MANY_MANY) {
				$model = $modelname::model();
				$result = $this->getDbConnection()->prepare("SELECT * FROM {$model->tableName()} JOIN $tablename ON {$model->tableName()}.{$model->getPK()}=$tablename.{$keys[1]} WHERE {$keys[0]}=:id;");
				$result->execute(array(
					':id' => $this->getPKValue(),
				));
				$items = $result->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_class($model));
				if(count($items) > 1) {
					$this->_attributes[$name] = $items;
					return $items;
				} else {
					$this->_attributes[$name] = $items[0];
					return $items[0];
				}
			}
		}
		return array();
	}

	public function __set($name,$value) {
		$this->_attributes[$name] = $value;
	}

	public function __isset($name) {
		if (isset($this->_attributes[$name]))
			return true;
		else
			return false;
	}

	public function __unset($name) {
		if (isset($this->_attributes[$name]))
			unset($this->_attributes[$name]);
	}

	public function __call($name,$parameters) {
		return parent::__call($name, $parameters);
	}

	public  function __construct($attributes = array()) {
		$this->_attributes = $attributes;
	}
}
