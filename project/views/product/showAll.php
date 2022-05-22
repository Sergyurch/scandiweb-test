<?php ob_start(); ?>
    <header class="d-sm-flex justify-content-between align-items-center px-2 pt-4 pb-2 border-bottom border-4
    border-secondary">
        <div class="fs-2">Product List</div>
        <div>
            <a href="/add-product" class="btn btn-primary me-3 shadow">ADD</a>
            <button type="submit" form="productsForm" class="btn btn-danger shadow">MASS DELETE</button>
        </div>
    </header>
<?php $headerBlock = ob_get_clean(); ?>

<?php ob_start(); ?>
    <main class="flex-fill">
        <form action="/product/delete" method="POST" id="productsForm" class="px-2 py-3 grid-container">
            <?php foreach ($products as $product) : ?>
                <div class="product border border-4 border-secondary rounded p-3">
                    <input type="checkbox" class="delete-checkbox" name="id_array[]" value="<?= $product->getId() ?>">
                    <div class="text-center"><?= $product->getSKU() ?></div>
                    <div class="text-center"><?= $product->getName() ?></div>
                    <div class="text-center"><?= number_format($product->getPrice(), 2) ?> $</div>
                    <div class="text-center">
                        <?= $product->getCategory()->getMainAttribute()->getName() ?>:
                        <?= $product->getMainAttributeValue() ?>
                        <?= $product->getCategory()->getMainAttribute()->getUnit() ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </form>
    </main>
<?php $contentBlock = ob_get_clean(); ?>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/project/layouts/$layout.php"; ?>
