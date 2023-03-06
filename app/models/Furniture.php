<?php

require_once  realpath(".") . '/app/models/' . 'Product.php';


class Furniture extends Product
{
    public string $type="furniture";

    public function __construct(
        private string $name,
        private float $price,
        private string $sku,
        private array $dimension
    ) {
        parent::__construct($name, $price, $sku, $this->getAttribute(), $this->type);
    }

	public function getAttribute() {
        return "{$this->dimension['height']}x{$this->dimension['width']}x{$this->dimension['length']}";

	}
}
