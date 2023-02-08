<?php 

/**
  * 
  */
 class Db_object 
 {
 	// Predefined upload errors bundled into an array
	public $upload_errors_array = array(

		UPLOAD_ERR_OK => "There is no error.",
		UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive.",
		UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive.",
		UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",	
		UPLOAD_ERR_NO_FILE => "No file was uploaded.",
		UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
		UPLOAD_ERR_CANT_WRITE=> "Failed to write file to disk.",
		UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
	);
 	
 

/* Parent class that other classes extends from */

	// finds all objects users
public static function find_all(){

// Makes query methods available	
global $database;

return static::find_by_query("SELECT * FROM ".static::$db_table." ");


} // End of find_all method



// Finds objects by id
public static function find_by_id($id){
global $database;
$sql = "SELECT * FROM ". static::$db_table." WHERE id = {$id}";

$result_array = static::find_by_query($sql);

// Ternary operator in use
return !empty($result_array)? array_shift($result_array): false;

}// End of find_by_id method


// Executes all query and returns result to the receiving method
public static function find_by_query($sql){
	global $database;
	$result_set = $database->query($sql);
	$object_array = array();
	while($row = mysqli_fetch_array($result_set)){

		$object_array[] = static::instantiation($row);
	}

	return $object_array;
}



public static function instantiation($record){

//Late static binding instantiates the calling class instead of the parent class

$calling_class = get_called_class();

$user_obj= new $calling_class;

foreach ($record as $property => $value) {
	if ($user_obj->has_the_property($property)){
		$user_obj->$property = $value;
	}
}

return $user_obj;

} // End of instantiation method

private function has_the_property($property)
{

	$object_properties = get_object_vars($this);

	return array_key_exists($property, $object_properties);
} // End of has_the_property method


//Method returns all object properties
protected function properties(){

	$properties = array();

	foreach(static::$db_table_fields as $db_field) {
		if(property_exists($this, $db_field)) {
			$properties[$db_field] = $this->$db_field;
		}
	}

	return $properties;
}

// Method cleans the properties before usage
protected function clean_properties(){
	global $database;

	$clean_properties = array();

	foreach ($this->properties() as $key => $value) {
		$clean_properties[$key] = $database->escape_string($value);
	}

	return $clean_properties;

}
//Save method detects if object already exist in the database

public function save() {
return isset($this->id) ? $this->update() : $this-> create();
}



// Create method creates database record by executing the insert query
public function create(){
global $database;
$properties = $this->clean_properties();

$sql = "INSERT INTO " . static::$db_table . "(" .implode(",", array_keys($properties)) .")";
$sql .= " VALUES ('".implode("', '", array_values($properties)) ."')"; // 
if ($database->query($sql)) {

	$this->id = $database->the_insert_id();
	return true;

} else {

	return false;

}

}



// The Update method updates record in the database.
public function update(){
global $database;
$properties = $this->clean_properties();

foreach($properties as $key => $value){
	$properties_pairs[] = "{$key}='{$value}'";
}

$sql = "UPDATE ". static::$db_table. " SET ";
$sql .= implode(", ", $properties_pairs);
$sql .= " WHERE id= " .$database->escape_string($this->id) ;

$database->query($sql);

return (mysqli_affected_rows($database->connection) == 1)? true: false; 
}


// This method deletes record from the database
public function delete(){
	global $database;

	$sql = "DELETE FROM ". static::$db_table. " " ;
	$sql .= " WHERE id= " .$database->escape_string($this->id) ;


	$database->query($sql);

	return (mysqli_affected_rows($database->connection) == 1)? true: false; 

}

// Counts the database objects
public static function count_all(){

	global $database;

	$sql = "SELECT COUNT(*) FROM ". static::$db_table;

	$result_set = $database->query($sql);

	$row = mysqli_fetch_array($result_set);


	return array_shift($row);


}


} // End of class

$db_object = new Db_object();

?>