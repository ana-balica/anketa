<?php
	// Your custom class dir
	define('CLASS_DIR', 'src');

	// Add your class dir to include path
	set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
	
	// You can use this trick to make autoloader look for commonly used "My.php" type filenames
	spl_autoload_extensions('.php');
	
	/**
	 * Classloader suitable for use with the first projects in BI-WT1 and BI-PWT
	 * Default classloader spl_autoload fails independently as well as with PHPUnit
	 * but is required for error handling! 
	 * @param string $class
	 */
	function wtProjectClassLoader($class) {
		$classPath = str_replace('\\', DIRECTORY_SEPARATOR, 
				CLASS_DIR.DIRECTORY_SEPARATOR.$class);
		// test if file exists and load it
		if (!file_exists("$classPath.php"))
			return false;
		// load the class
		require_once("$classPath.php");
		// test if class/interface exists
		if (class_exists($class, false) || interface_exists($class, false))
			return true; 
		// exception
		throw new LogicException("Class $class failed to load. File was found 
				but the class was not in it.");
	}

	// Register project specific autoloader implementation
	spl_autoload_register('wtProjectClassLoader');

	// Register default autoload implementation also
	spl_autoload_register('spl_autoload');
