<?php

namespace Models;

class Product extends Model
{
	protected $name;
	protected $variations;
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

	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
		$this->markDirty();
	}

	public function getVariations()
	{
		return $this->variations;
	}

	public function setVariations($variations)
	{
		$this->variations = $variations;
	}

	public function transform()
	{
		$variations = [];
		foreach ($this->getVariations()->getGenerator() as $variation) {
			$variations[] = $variation->transform();
		}

		return [
			'id' => $this->getId(),
			'name' => $this->getName(),
			'variations' => $variations,
			'created_at' => $this->getCreatedAt(),
		];
	}
}