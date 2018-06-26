<?php

namespace hw11\classes;

class Basket 
{
    public $productBasket = [];
    
    public function addProduct($product)
    {                                    
        $product -> countProduct = 1; 
     
        if(array_key_exists($product -> name, $this -> productBasket)) {
            $this -> productBasket[$product -> name] -> countProduct++;            
        } else {
            $this -> productBasket[$product -> name] = $product;
        }
        echo "Товар {$product -> name} добавлен в корзину.<br>";
    }
   
    public function deleteAllProduct($product)
    {
        echo "{$product -> name} удалён<br>";
        unset ($this -> productBasket[$product -> name]);
    }
   
    public function deleteOneProduct($product)
    {
        if(array_key_exists($product -> name, $this -> productBasket)) {       
            if ($this -> productBasket[$product -> name] -> countProduct > 0) {          
                $this -> productBasket[$product -> name] -> countProduct--; 
                echo "Товар {$this -> productBasket[$product -> name] -> name} удалён из корзины.<br>";
            }
        }
    }

    public function showBasket()
    {
        $sum = 0;
       
        foreach($this -> productBasket as $key => $value){
            $priceProduct = $value -> getPrice() * $value -> countProduct;
            $sum = $sum + $priceProduct;

            echo "$key, количество: {$value -> countProduct}, цена $priceProduct.<br>";  
        }
        echo "Сумма к оплате $sum.<br>";       
    }
}