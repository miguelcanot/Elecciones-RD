<?php
// to be used for database issues 
class Exception_b extends Exception { 
 
    // you may add any custom methods 
     public function __construct() { 
 	echo "sada";
        // log this error somewhere 
        // ... 
    } 
} 
 
// to be used for file system issues 
class FileException extends Exception { 
 
    // ... 
 
}
?>