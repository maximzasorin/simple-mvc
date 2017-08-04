<?php

namespace Models;

class Variation extends Model
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
		$this->markDirty();
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function setPrice($price)
	{
		$this->price = $price;
		$this->markDirty();
	}

	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
		$this->markDirty();
	}

	public function transform()
	{
		return [
			'id' => $this->getId(),
			'name' => $this->getName(),
			'price' => $this->getPrice(),
			'created_at' => $this->getCreatedAt(),
		];
	}
}