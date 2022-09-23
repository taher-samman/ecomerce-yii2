<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Pepsi Products'; ?>
<div class="container admin-products-grid">
    <div class="toolbar">
        <h1 class="title"><?= $this->title ?></h1>
        <div class="action-product">
            <a href="<?= Url::toRoute('add') ?>">
                Add Product
            </a>
        </div>
    </div>
    <div class="grid">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Sku</th>
                    <th scope="col">Status</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Special Price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Max Qty</th>
                    <th scope="col">Min Qty</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($products as $key => $product) {
                ?>
                    <tr>
                        <th scope="row"><?= $product->id ?></th>
                        <td><?= $product->name ?></td>
                        <td><?= $product->sku ?></td>
                        <td><?= $product->status ?></td>
                        <td><?= $product->description ?></td>
                        <td><?= $product->price_formated ?></td>
                        <td><?= $product->special_price_formated ?></td>
                        <td><?= $product->qty ?></td>
                        <td><?= $product->max_qty_allowed ?></td>
                        <td><?= $product->min_qty_allowed ?></td>
                        <td><?= $product->created_at ?></td>
                        <td><?= $product->updated_at ?></td>
                        <td><a href="<?= Url::to(['products/edit', 'id' => $product->id]) ?>">Edit</a></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>