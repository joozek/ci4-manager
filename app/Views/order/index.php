<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>List of Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/global.css" />
</head>

<body>
    <div id="container">
        <?= form_open($action->search, ['class' => 'search', 'method' => "GET"]); ?>
        <input type="search" name="uuid" value="" class="order__input order__input--margined" placeholder="Search UUID" />
        <input type="search" name="status" value="" class="order__input order__input--margined" placeholder="Search status" />
        <input type="search" name="shipping_total" value="" class="order__input order__input--margined" placeholder="Search total shipping" />
        <input type="search" name="shipment" value="" class="order__input order__input--margined" placeholder="Search shipment" />
        <select name="order_by" class="order__input">
            <option value="">Sort by</option>
            <option value="uuid">UUID</option>
            <option value="status">Status</option>
            <option value="shipping_total">Shipping Total</option>
            <option value="shipment">Shipment</option>
        </select>
        <label for="is_desc" class="order__checkbox">
            <p>Desc</p>
            <input id="is_desc" type="checkbox" name="is_desc" />
        </label>
        <input type="submit" value="Search" class="order__button" />
        </form>
        <div class="list">
            <h1 class="list__title"><strong>UUID</strong></h1>
            <p class="list__header"><strong>Status</strong></p>
            <p class="list__header"><strong>Shipping Total</strong></p>
            <p class="list__header"><strong>Shipment</strong></p>
            <div class="list__btns"><strong>Functions</strong></div>
        </div>
        <?php if (!empty($orders)) : ?>
            <?php foreach ($orders as $o) : ?>
                <div class="list">
                    <p class="list__title"><?= $o['uuid'] ?></p>
                    <p><?= str_replace(['ORDER_', '_'], ' ', $o['status']) ?></p>
                    <p><?= str_replace(['ORDER_', '_'], ' ', $o['shipping_total']) ?></p>
                    <p><?= str_replace(['ORDER_', '_'], ' ', $o['shipment']) ?></p>
                    <div class="list__btns">
                        <form action="<?= $action->show ?>" method="POST">
                            <input type="hidden" name="uuid" value="<?= $o['uuid'] ?>" />
                            <button class="list__button"><i class="fa fa-eye"></i></button>
                        </form>
                        <form action="<?= $action->remove ?>" method="POST">
                            <input type="hidden" name="uuid" value="<?= $o['uuid'] ?>" />
                            <button class="list__button "><i class="fa fa-trash-o"></i></button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="list">
                <h2>Any results.</h1>
            </div>
        <?php endif; ?>
        <form method="POST" action="<?= $action->create ?>">
            <button class="order__button">Create new order</button>
        </form>
        <?= $pager->links() ?>
</body>

</html>