<?php

namespace Mappers;

use Models\Model;

class ProductMapper extends Mapper
{
	public function __construct()
	{
		parent::__construct();

		$this->findStatement = self::$pdo->prepare(
			'SELECT * FROM products WHERE id = ?'
		);

		$this->findAllStatement = self::$pdo->prepare(
			'SELECT * FROM products'
		);

		$this->updateStatement = self::$pdo->prepare(
			'UPDATE products SET name = ?, id = ? WHERE id = ?'
		);

		$this->insertStatement = self::$pdo->prepare(
			'INSERT INTO products (name) VALUES (?)'
		);

		$this->deleteStatement = self::$pdo->prepare(
			'DELETE FROM products WHERE id = ?'
		);

		$this->persistenceFactory = new ProductPersistenceFactory;
	}

	protected function getCollection(array $raw)
	{
		return $this->persistenceFactory->getCollection($raw);
	}

	protected function doInsert(Model $product)
	{
		$this->insertStatement->execute([$product->getName()]);
		$product->setId(self::$pdo->lastInsertId());
	}

	protected function doUpdate(Model $product)
	{
		$this->updateStatement->execute([
			$product->getName(),
			$product->getId(),
			$product->getId()
		]);
	}

	protected function doDelete(Model $product)
	{
		$this->deleteStatement->execute([$product->getId()]);
	}
}