<?php

class SPG_Api_Model_Galleries extends SPG_Api_Model_Common {
	
	public function __construct() {
		parent::__construct('galleries');
	}
	
	public function getList($path=null) {
		//$path = str_replace('%2f', '/', $path);		
		if (!empty($path)) {
			$whereCondition = "`file` LIKE '${path}/%' AND `file` NOT LIKE '${path}/%/%'";
		} else {
			$whereCondition = "`file` NOT LIKE '%/%'";
		}
		return parent::getList($whereCondition, 'name');
	}
	
	public function getItemByCondition($file) {
		// Create a string to find all parent galleries and the gallery itself.
		// e.g. "cars/bmw/1950" => "'cars/bmw/1950', 'cars/bmw', 'cars'"
		$galleryFiles = "'{$file}'";
		while($pos = strrpos($file, '/')) {
			$file = substr($file, 0, $pos);
			$galleryFiles .= ", '{$file}'";
		}
		
		// Query for the gallery and its parents by using the WHERE IN syntax.
		$result = $this->model->getMultiple("`file` IN ({$galleryFiles})", "file", NULL, NULL, WPLDK_Database_Model::OUTPUT_TYPE_ARRAY_A);
		// Get the gallery, which is the last element of the array since the
		// quere was ordered ascend by the file column.
		$gallery = array_pop($result);
		// The depth is the number of parent galleries, i.e. the size of the
		// array.
		$gallery['depth'] = sizeof($result);
		// Add the parents, which is the rest of the array since the array_pop
		// operation removes the last item.
		$gallery['parents'] = $result;

		return $gallery;
	}
}