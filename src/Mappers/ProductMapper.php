<?php

namespace Mappers;

use Models\Model;
use Models\Product;

class ProductMapper extends Mapper
{
	protected $findAllStatement;

	public function __construct()
	{
		parent::__construct();

		$this->selectStatement = self::$pdo->prepare(
			'SELECT * FROM products WHERE id = ?'
		);

		$this->updateStatement = self::$pdo->prepare(
			'UPDATE products SET name = ?, id = ? WHERE id = ?'
		);

		$this->insertStatement = self::$pdo->prepare(
			'INSERT INTO products (name) VALUES (?)'
		);

		$this->findAllStatement = self::$pdo->prepare(
			'SELECT * FROM products'
		);
	}

	public function findAll()
	{
		$this->findAllStatement->execute();

		$collection = $this->getCollection($this->findAllStatement->fetchAll(\PDO::FETCH_ASSOC));

		// var_dump($collection);

		return $collection->getGenerator();
	}

	protected function getCollection(array $raw)
	{
		return new ProductCollection($raw, $this);
	}

	protected function doCreateObject(array $array)
	{
		$product = new Product($array[$id]);
		$product->setName($array['name']);
		$product->setCreatedAt($array['created_at']);

		return $product;
	}

	protected function doInsert(Model $model)
	{
		$this->insertStatement->execute([$product->getName()]);
		$product->setId(self::$pdo->lastInsertId());
	}

	public function doUpdate(Model $model)
	{
		$this->updateStatement->execute([
			$product->getName(),
			$product->getId(),
			$product->getId()
		]);
	}
}