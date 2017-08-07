<?php

namespace Mappers;

use Models\Model;

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

		$this->persistenceFactory = new VariationPersistenceFactory;
	}

	public function findByProductId($productId)
	{
		return new DefferedVariationCollection($this->persistenceFactory->getModelFactory(), $this->findByProductIdStatement, [$productId]);
	}

	protected function getCollection(array $raw)
	{
		return $this->persistenceFactory->getCollection($raw);
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