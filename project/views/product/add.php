<?php ob_start(); ?>
    <header class="d-sm-flex justify-content-between align-items-center px-2 pt-4 pb-2 border-bottom border-4
        border-secondary">
        <div class="fs-2">Product Add</div>
        <div>
            <button type="submit" form="product_form" class="btn btn-primary me-3 shadow">Save</button>
            <a href="/" class="btn btn-primary shadow">Cancel</a>
        </div>
    </header>
<?php $headerBlock = ob_get_clean(); ?>

<?php ob_start(); ?>
    <main class="flex-fill">
        <form method="POST" id="product_form" class="px-2 py-3 needs-validation" novalidate>
            <div class="row mb-3">
                <label for="sku" class="col-sm-3 col-md-2 col-form-label">SKU</label>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <input type="text" id="sku" name="sku" class="form-control checkValidity">
                    <div class="invalid-feedback" id="skuError"></div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="name" class="col-sm-3 col-md-2 col-form-label">Name</label>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <input type="text" id="name" name="name" class="form-control checkValidity">
                    <div class="invalid-feedback" id="nameError"></div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="price" class="col-sm-3 col-md-2 col-form-label">Price ($)</label>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <input type="number" id="price" name="price" class="form-control checkValidity"
                           placeholder="e.g. 1.23">
                    <div class="invalid-feedback" id="priceError"></div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="productType" class="col-sm-3 col-md-2 col-form-label">Type Switcher</label>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <select id="productType" name="type" class="form-select" onchange="showFields()">
                        <option>Book</option>
                        <option>DVD</option>
                        <option>Furniture</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3" id="DVD" style="display: none;">
                <div class="row">
                    <div id="sizeHelp" class="form-text text-primary">Please, provide size.</div>
                </div>
                <label for="size" class="col-sm-3 col-md-2 col-form-label align-self-end">Size (MB)</label>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <input type="number" id="size" name="size" class="form-control checkValidity"
                           aria-describedby="sizeHelp" disabled>
                    <div class="invalid-feedback" id="sizeError"></div>
                </div>
            </div>
            <div class="flex-column mb-3" id="Furniture" style="display: none;" aria-describedby="dimensionHelp">
                <div class="row">
                    <div id="dimensionHelp" class="form-text text-primary">Please, provide dimensions.</div>
                </div>
                <div class="row mb-3">
                    <label for="height" class="col-sm-3 col-md-2 col-form-label">Height (CM)</label>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <input type="number" id="height" name="height" class="form-control checkValidity" disabled>
                        <div class="invalid-feedback" id="heightError"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="width" class="col-sm-3 col-md-2 col-form-label">Width (CM)</label>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <input type="number" id="width" name="width" class="form-control checkValidity" disabled>
                        <div class="invalid-feedback" id="widthError"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="length" class="col-sm-3 col-md-2 col-form-label">Length (CM)</label>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <input type="number" id="length" name="length" class="form-control checkValidity" disabled>
                        <div class="invalid-feedback" id="lengthError"></div>
                    </div>
                </div>
            </div>
            <div class="row mb-3" id="Book" style="display: none;">
                <div class="row">
                    <div id="weightHelp" class="form-text text-primary">Please, provide weight.</div>
                </div>
                <label for="weight" class="col-sm-3 col-md-2 col-form-label align-self-end">Weight (KG)</label>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <input type="number" id="weight" name="weight" class="form-control checkValidity"
                           aria-describedby="weightHelp" disabled>
                    <div class="invalid-feedback" id="weightError"></div>
                </div>
            </div>
        </form>
    </main>
<?php $contentBlock = ob_get_clean(); ?>

<?php ob_start(); ?>
    <script src="/project/public/js/script.js"></script>
<?php $scriptBlock = ob_get_clean(); ?>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/project/layouts/$layout.php"; ?>
