<?php
/**
 * @var \App\models\Product $product
 */
?>

<div class="product-details">
    <h1><?= $product['name'] ?></h1>
    <p><?= 'This product costs ' . $product['price'] . ' dollars.' ?></p>
    <p><?= 'Description: ' . $product['description'] ?></p>
</div>