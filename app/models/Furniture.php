<?php

require_once  realpath(".") . '/app/models/' . 'Product.php';


class Furniture extends Product
{
    public string $type="furniture";

    public function __construct(
        string $name,
        float $price,
        string $sku,
        private array $dimension
    ) {
        parent::__construct($name, $price, $sku, $this->getAttribute(), $this->type);
    }

	public function getAttribute() {
        return "{$this->dimension['height']}x{$this->dimension['width']}x{$this->dimension['length']}";

	}
}
