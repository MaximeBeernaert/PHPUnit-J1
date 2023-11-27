<?php

class ShoppingCart
{
    private $items = ['Boeuf' => 4];

    public function getItems(){
        return $this->items;
    }

    public function addItem($product, $quantity)
    {
        // Ajoute un produit au panier avec une quantité donnée
        // Si le produit est déjà dans le panier, la quantité est augmentée
        // Si la quantité est <= 0, lance une InvalidArgumentException

        if(array_key_exists($product, $this->items)) {
            $this->items[$product] += $quantity;
            return $this->items[$product];
        }        
        if($product == '') {
            throw new InvalidArgumentException('Product name cannot be empty');
            return false;
        }

        if($quantity <= 0) {
            throw new InvalidArgumentException('Quantity must be greater than 0');
        }

        $this->items[$product] = $quantity;

        return $this->items[$product];
    }

    public function removeItem($product, $quantity)
    {
        // Retire une quantité donnée d'un produit du panier
        // Si le produit n'est pas dans le panier, lance une OutOfRangeException
        // Si la quantité à retirer est supérieure à la quantité dans le panier, lance une OutOfRangeException

        if($product == '') {
            throw new InvalidArgumentException('Product name cannot be empty');
            return false;
        }   

        if(!array_key_exists($product, $this->items)) {
            throw new OutOfRangeException('Product not in cart');
        }

        if(array_key_exists($product, $this->items) && $quantity > $this->items[$product]) {
            throw new OutOfRangeException('Quantity to remove is greater than quantity in cart');
        }

        $this->items[$product] -= $quantity;

        return $this->items[$product];
    }

    public function getQuantity($product)
    {
        // Récupère la quantité d'un produit dans le panier
        // Si le produit n'est pas dans le panier, retourne 0

        if($product == '') {
            throw new InvalidArgumentException('Product name cannot be empty');
        }else if(!array_key_exists($product, $this->items)) {
            return 0;
        }

        return $this->items[$product];
    }
}
