<?php
/**
 * @var array $products
 * @var \App\models\Product $product
 */
?>

<div class="products">
<?php foreach ($products as $product) : ?>
<div class="product">
    <h1><?= $product['name'] ?></h1>
    <p><?= 'This product costs ' . $product['price'] . ' dollars.' ?></p>
    <p><?= 'Description: ' . $product['description'] ?></p>
    <a href=<?= "/lesson_02/public/?contr=product&action=product&id={$product['id']}" ?>>Details</a>
</div>
<?php endforeach; ?>
</div>