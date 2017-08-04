<?php

namespace Mappers;

use Models\Model;
use Models\Product;
use Models\Variation;

class VariationMapper extends Mapper
{
	protected $findByProductIdStatement;

	public function __construct()
	{
		parent::__construct();

		$this->findStatement = self::$pdo->prepare(
			'SELECT * FROM variations WHERE id = ?'
		);

		$this->updateStatement = self::$pdo->prepare(
			'UPDATE variations SET name = ?, id = ? WHERE id = ?'
		);

		$this->insertStatement = self::$pdo->prepare(
			'INSERT INTO variations (name) VALUES (?)'
		);

		$this->deleteStatement = self::$pdo->prepare(
			'DELETE FROM variations WHERE id = ?'
		);

		$this->findAllStatement = self::$pdo->prepare(
			'SELECT * FROM variations'
		);

		$this->findByProductIdStatement = self::$pdo->prepare(
			'SELECT * FROM variations WHERE product_id = ?'
		);
	}

	public function findByProductId($productId)
	{
		return new DefferedVariationCollection($this, $this->findByProductIdStatement, [$productId]);
	}

	public function targetClass()
	{
		return 'Models\Variation';
	}

	protected function getCollection(array $raw)
	{
		return new VariationCollection($raw, $this);
	}

	protected function doCreateObject(array $array)
	{
		$variation = new Variation($array['id']);
		$variation->setName($array['name']);
		$variation->setPrice($array['price']);
		$variation->setCreatedAt($array['created_at']);

		return $variation;
	}

	protected function doInsert(Model $variation)
	{
		$this->insertStatement->execute([$variation->getName()]);
		$variation->setId(self::$pdo->lastInsertId());
	}

	protected function doUpdate(Model $variation)
	{
		$this->updateStatement->execute([
			$variation->getName(),
			$variation->getId(),
			$variation->getId()
		]);
	}

	protected function doDelete(Model $variation)
	{
		$this->deleteStatement->execute([$variation->getId()]);
	}
}