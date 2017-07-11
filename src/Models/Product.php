<?php

namespace Models;

class Product extends Model
{
	protected $name;
	protected $images;

	public function __construct()
	{
		
	}

	public function getName()
	{
		return $this->name;
	}

	public function getImages()
	{
		return $this->images;
	}
}