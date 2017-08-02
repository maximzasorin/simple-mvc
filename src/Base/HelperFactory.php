<?php

namespace Base;

class HelperFactory
{
	static public function getFinder($type)
	{
		$modelClass = substr($type, strpos($type, '\\') + 1);
		$mapperClass = 'Mappers\\' . $modelClass . 'Mapper';

		$mapperReflection = new \ReflectionClass($mapperClass);
		$mapper = $mapperReflection->newInstance();

		return $mapper;
	}

	static public function getCollection($type)
	{
		$modelClass = substr($type, strpos($type, '\\') + 1);
		$collectionClass = 'Mappers\\' . $modelClass . 'Collection';

		$collectionReflection = new \ReflectionClass($collectionClass);
		$collection = $collectionReflection->newInstance();

		return $collection;
	}
}