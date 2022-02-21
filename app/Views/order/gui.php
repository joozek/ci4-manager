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
            <div class="search list">
                <input type="hidden" name="<?= $perPageField ?>" value="<?= getIfPropertyExists($form, 'perPage') ?>" />
                <input type="hidden" name="page" value="<?= getIfPropertyExists($form, 'page') ?>" />
                <input type="search" name="UUID" value="<?= getIfPropertyExists($form, 'uuid') ?>" class="search__input" placeholder="Search UUID" />
                <input type="search" name="status" + value="<?= getIfPropertyExists($form, 'status') ?>" class="search__input" placeholder="Search status" />
                <input type="search" name="shipping" value="<?= getIfPropertyExists($form, 'shipping') ?>" class="search__input" placeholder="Search total shipping" />
                <input type="search" name="shipment" value="<?= getIfPropertyExists($form, 'shipment') ?>" class="search__input" placeholder="Search shipment" />
                <input type="submit" value="Search" class="search__button" />
            </div> 
            <div class="list header">
                <div class="list__header">
                    <h3>UUID</h3>
                    <button class="arrow">
                        <?php
                        if (isset($form->sort_uuid) && $form->sort_uuid === 'DESC') {
                            echo '<i class="fa fa-sort-up"></i>';
                        } elseif (isset($form->sort_uuid) && $form->sort_uuid === 'ASC') {
                            echo '<i class="fa fa-sort-down"></i>';
                        } else {
                            echo '<i class="fa fa-sort"></i>';
                        }
                        ?>
                    </button>
                    <input type="hidden" name="sort_uuid" value="<?= ($form->sort_uuid ?? '') ?>" />
                </div>
                <div class="list__header">
                    <h3>Status</h3>
                    <button class="arrow">
                        <?php
                        if (isset($form->sort_status) && $form->sort_status === 'DESC') {
                            echo '<i class="fa fa-sort-up"></i>';
                        } elseif (isset($form->sort_status) && $form->sort_status === 'ASC') {
                            echo '<i class="fa fa-sort-down"></i>';
                        } else {
                            echo '<i class="fa fa-sort"></i>';
                        }
                        ?>
                    </button>
                    <input type="hidden" name="sort_status" value="<?= ($form->sort_status ?? '') ?>" />
                </div>
                <div class="list__header">
                    <h3>Shipping Total</h3>
                    <button class="arrow">
                        <?php
                        if (isset($form->sort_shipping_total) && $form->sort_shipping_total === 'DESC') {
                            echo '<i class="fa fa-sort-up"></i>';
                        } elseif (isset($form->sort_shipping_total) && $form->sort_shipping_total === 'ASC') {
                            echo '<i class="fa fa-sort-down"></i>';
                        } else {
                            echo '<i class="fa fa-sort"></i>';
                        }
                        ?>
                    </button>
                    <input type="hidden" name="sort_shipping" value="<?= ($form->sort_shipping_total ?? '') ?>" />
                </div>
                <div class="list__header">
                    <h3>Shipment</h3>
                    <button class="arrow">
                        <?php
                        if (isset($form->sort_shipment) && $form->sort_shipment === 'DESC') {
                            echo '<i class="fa fa-sort-up"></i>';
                        } elseif (isset($form->sort_shipment) && $form->sort_shipment === 'ASC') {
                            echo '<i class="fa fa-sort-down"></i>';
                        } else {
                            echo '<i class="fa fa-sort"></i>';
                        }
                        ?>
                    </button>
                    <input type="hidden" name="sort_shipment" value="<?= ($form->sort_shipment ?? '') ?>" />
                </div>
                <div class="list__btns">
                    <h3>Manage</h3>
                </div>
            </div>
        </form>
        <?php if (count($orders) !== 0) : ?>
            <?php foreach ($orders as $o) : ?>
                <div class="list">
                    <p>
                        <?= $o->uuid ?>
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
                        <form method="POST" action="<?= $action->show ?>">
                            <input type="hidden" name="uuid" value="<?= $o->uuid ?>" />
                            <button class="list__button"><i class="fa fa-eye"></i></button>
                        </form>
                        <form method="POST" action="<?= $action->remove ?>">
                            <input type="hidden" name="uuid" value="<?= $o->uuid ?>" />
                            <button class="list__button "><i class="fa fa-trash-o"></i></button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="list">
                <h2 class="any">Any results.</h1>
            </div>
        <?php endif; ?>
        <div class="links">
        <?= $pagination ?>
        </div>
        <?= $export ?>
    </div>
    <script src="js/script.js"></script>
</body>

</html>