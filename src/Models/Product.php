<?php

namespace Models;

class Product extends Model
{
	protected $name;
	protected $createdAt;

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}

	public function transform()
	{
		return [
			'name' => $this->getName(),
			'created_at' => $this->getCreatedAt(),
		];
	}
}