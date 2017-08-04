<?php

namespace Mappers;

use Models\Model;
use Models\Product;
use Models\Variation;

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
	}

	public function targetClass()
	{
		return 'Models\Product';
	}

	protected function getCollection(array $raw)
	{
		return new ProductCollection($raw, $this);
	}

	protected function doCreateObject(array $array)
	{
		$product = new Product($array['id']);
		$product->setName($array['name']);
		$product->setCreatedAt($array['created_at']);

		$variationMapper = new VariationMapper;
		$variationCollection = $variationMapper->findByProductId($array['id']);

		$product->setVariations($variationCollection);

		return $product;
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