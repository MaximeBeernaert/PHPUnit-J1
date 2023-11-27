<?php
use PHPUnit\Framework\TestCase;
require_once 'src/ShoppingCart.php';


class ShoppingCartTest extends TestCase
{
    /**
     * @dataProvider shoppingCartDataProvider
     */
 
    public function testShoppingCartOperations($operation, $a, $b, $expected) {
        $shoppingCart = new ShoppingCart();
        if($operation == 'addItem') {
            if($a == ''){
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Product name cannot be empty');
            }
            if($b <= 0) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Quantity must be greater than 0');
            }



            $result = $shoppingCart->addItem($a, $b);

        } elseif($operation == 'removeItem') {
            if($a == ''){
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Product name cannot be empty');
            }else if(!array_key_exists($a, $shoppingCart->getItems())) {
                $this->expectException(OutOfRangeException::class);
                $this->expectExceptionMessage('Product not in cart');
            }else if($b > $shoppingCart->getItems()[$a]) {
                $this->expectException(OutOfRangeException::class);
                $this->expectExceptionMessage('Quantity to remove is greater than quantity in cart');
            }

            $result = $shoppingCart->removeItem($a, $b);
        } elseif($operation == 'getQuantity') {

            if($a == ''){
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Product name cannot be empty');
            }else if(!array_key_exists($a, $shoppingCart->getItems())) {
                $result = 0;
            }

            $result = $shoppingCart->getQuantity($a);
        }
        $this->assertEquals($expected, $result);
    }
    
    public function shoppingCartDataProvider() {
        return [
            ['addItem', 'Poisson', 2, 2],
            ['addItem', '' , 2, false],
            ['addItem', 'Boeuf', 4, 8],
            ['addItem', 'Poisson', 0, false],

            ['removeItem', 'Boeuf', 1, 3],
            ['removeItem', '', 3, false],
            ['removeItem', 'Boeuf', 0, 4],
            ['removeItem', 'Poisson', 8, false],
            ['removeItem', 'Boeuf', 8, false],

            ['getQuantity', 'Poisson', '',0],
            ['getQuantity', 6, '', false],
            ['getQuantity', '', '', false]
        ];
    }
}


?>