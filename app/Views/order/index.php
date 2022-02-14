<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>List of Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/global.css" />
</head>

<body>
    <div id="container">
        <form id="search" action="<?= $action->search ?>" method="post">
            <div class="search">
                <input type="search" name="uuid" value="<?= show_if_exists($form, 'uuid') ?>" class="order__input order__input--margined" placeholder="Search UUID" />
                <input type="search" name="status" + value="<?= show_if_exists($form, 'status') ?>" class="order__input order__input--margined" placeholder="Search status" />
                <input type="search" name="shipping_total" value="<?= show_if_exists($form, 'shipping_total') ?>" class="order__input order__input--margined" placeholder="Search total shipping" />
                <input type="search" name="shipment" value="<?= show_if_exists($form, 'shipment') ?>" class="order__input order__input--margined" placeholder="Search shipment" />
                <input type="submit" value="Search" class="order__button" />
            </div>
            <div class="list">
                <p class="list__header">
                    <strong>UUID</strong>
                    <button class="arrow">
                        <?php
                        if (isset($form->sort_uuid) && $form->sort_uuid === 'DESC') {
                            echo '<i class="fa fa-arrow-up"></i>';
                        } else if (isset($form->sort_uuid) && $form->sort_uuid === 'ASC') {
                            echo '<i class="fa fa-arrow-down"></i>';
                        } else {
                            echo '<i class="fa fa-arrow-down"></i><i class="fa fa-arrow-up"></i>';
                        }
                        ?>
                    </button>
                    <input type="hidden" class="soir" name="sort_uuid" value="<?= ($form->sort_uuid ?? '') ?>" />
                </p>
                <p class="list__header">
                    <strong>Status</strong>
                    <button class="arrow">
                        <?php
                        if (isset($form->sort_status) && $form->sort_status === 'DESC') {
                            echo '<i class="fa fa-arrow-up"></i>';
                        } else if (isset($form->sort_status) && $form->sort_status === 'ASC') {
                            echo '<i class="fa fa-arrow-down"></i>';
                        } else {
                            echo '<i class="fa fa-arrow-down"></i><i class="fa fa-arrow-up"></i>';
                        }
                        ?>
                    </button>
                    <input type="hidden" class="soir" name="sort_status" value="<?= ($form->sort_status ?? '') ?>" />
                </p>
                <p class="list__header">
                    <strong>Shipping Total</strong>
                    <button class="arrow">
                        <?php
                        if (isset($form->sort_shipping_total) && $form->sort_shipping_total === 'DESC') {
                            echo '<i class="fa fa-arrow-up"></i>';
                        } else if (isset($form->sort_shipping_total) && $form->sort_shipping_total === 'ASC') {
                            echo '<i class="fa fa-arrow-down"></i>';
                        } else {
                            echo '<i class="fa fa-arrow-down"></i><i class="fa fa-arrow-up"></i>';
                        }
                        ?>
                    </button>
                    <input type="hidden" class="soir" name="sort_shipping_total" value="<?= ($form->sort_shipping_total ?? '') ?>" />
                </p>
                <p class="list__header">
                    <strong>Shipment</strong>
                    <button class="arrow">
                        <?php
                        if (isset($form->sort_shipment) && $form->sort_shipment === 'DESC') {
                            echo '<i class="fa fa-arrow-up"></i>';
                        } else if (isset($form->sort_shipment) && $form->sort_shipment === 'ASC') {
                            echo '<i class="fa fa-arrow-down"></i>';
                        } else {
                            echo '<i class="fa fa-arrow-down"></i><i class="fa fa-arrow-up"></i>';
                        }
                        ?>
                    </button>
                    <input type="hidden" class="soir" name="sort_shipment" value="<?= ($form->sort_shipment ?? '') ?>" />
                </p>
                <p class="list__btns">
                    <strong>Functions</strong>
                </p>
            </div>
        </form>
        <?php if (count($orders) !== 0) : ?>
            <?php foreach ($orders as $o) : ?>
                <div class="list">
                    <p class="">
                        <?= reduceStringToLength($o->uuid, 20) ?>
                    </p>
                    <p>
                        <?= str_replace(['ORDER_', '_'], ' ', $o->status) ?>
                    </p>
                    <p>
                        <?= str_replace(['ORDER_', '_'], ' ', $o->shipping_total) ?>
                    </p>
                    <p>
                        <?= str_replace(['ORDER_', '_'], ' ', $o->shipment) ?>
                    </p>
                    <div class="list__btns">
                        <div>
                            <input type="hidden" name="ouuid" value="<?= $o->uuid ?>" />
                            <button class="list__button"><i class="fa fa-eye"></i></button>
                        </div>
                        <div>
                            <input type="hidden" name="$ouuid" value="<?= $o->uuid ?>" />
                            <button class="list__button "><i class="fa fa-trash-o"></i></button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="list">
                <h2>Any results.</h1>
            </div>
        <?php endif; ?>
        <div class="buttons">
            <form method="POST" action="<?= $action->json ?>">
                <button class="order__button export">Export (.json)</button>
            </form>
            <form method="POST" action="<?= $action->xlsx ?>">
                <button class="order__button export">Export (.xlsx)</button>
            </form>
            <form method="POST" action="<?= $action->csv ?>">
                <button class="order__button export">Export (.csv)</button>
            </form>
            <form method="POST" action="<?= $action->docx ?>">
                <button class="order__button export">Export (.docx)</button>
            </form>
        </div>
        <?= $links ?>
    </div>
    <script src="js/script.js"></script>
</body>

</html>