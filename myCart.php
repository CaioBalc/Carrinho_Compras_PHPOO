<?php

require "product.php";
require "cart.php";

session_start();

$cart = new Cart;
$productsInCart = $cart->getCart();

var_dump($productsInCart);

if(isset($_GET["id"])){
    $id = strip_tags($_GET["id"]);
    $cart->remove($id);
    header("Location: myCart.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/index.php">Go to home</a>
    <ul>
        <?php if(count($productsInCart) <=0): ?>
            Nenhun produto no carrinho
        <?php endif; ?>
        <?php foreach($productsInCart as $product): ?>
        <li><?php echo $product->getname(); ?></li>
        <input type="text" value="<?php echo $product->getQuantity()?>">
        Price: R$ <?php echo number_format($product->getPrice(), 2, ",", ".")?>
        Subtotal: R$ <?php echo number_format ($product->getPrice() * $product->getQuantity(), 2, ",", ".")?>
        <a href="?id=<?php echo $product->getId(); ?>">remove</a>
        <?php endforeach; ?>
        <li>Total: R$ <?php echo number_format($cart->getTotal(), 2, ",", ".");?></li>
    </ul>
</body>
</html>