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
                <input type="search" name="UUID" value="<?= getIfPropertyExists($form, 'UUID') ?>" class="search__input" placeholder="Search UUID" />
                <input type="search" name="Status" + value="<?= getIfPropertyExists($form, 'Status') ?>" class="search__input" placeholder="Search status" />
                <input type="search" name="Shipping" value="<?= getIfPropertyExists($form, 'Shipping') ?>" class="search__input" placeholder="Search total shipping" />
                <input type="search" name="Shipment" value="<?= getIfPropertyExists($form, 'Shipment') ?>" class="search__input" placeholder="Search shipment" />
                <input type="submit" value="Search" class="search__button" />
            </div> 
            <div class="list header">
                <div class="list__header">
                    <h3>UUID</h3>
                    <button class="arrow">
                        <?= getSortIcon($form, 'sortUUID') ?>
                    </button>
                    <input type="hidden" name="sortUUID" value="<?= ($form->sortUUID ?? '') ?>" />
                </div>
                <div class="list__header">
                    <h3>Status</h3>
                    <button class="arrow">
                        <?= getSortIcon($form, 'sortStatus') ?>
                    </button>
                    <input type="hidden" name="sortStatus" value="<?= ($form->sortStatus ?? '') ?>" />
                </div>
                <div class="list__header">
                    <h3>Shipping</h3>
                    <button class="arrow">
                        <?= getSortIcon($form, 'sortShipping') ?>
                    </button>
                    <input type="hidden" name="sortShipping" value="<?= ($form->sortShipping ?? '') ?>" />
                </div>
                <div class="list__header">
                    <h3>Shipment</h3>
                    <button class="arrow">
                       <?= getSortIcon($form, 'sortStatus') ?>
                    </button>
                    <input type="hidden" name="sortShipment" value="<?= ($form->sortShipment ?? '') ?>" />
                </div>
                <div class="list__btns">
                    <h3>Manage</h3>
                </div>
            </div>
            <?= getSearchJS() ?>
        </form>
        <?php if (!empty($orders)) : ?>
            <?php foreach ($orders as $o) : ?>
                <div class="list">
                    <p>
                        <?= $o->UUID ?>
                    </p>
                    <p>
                        <?= str_replace(['ORDER_', '_'], ' ', $o->Status) ?>
                    </p>
                    <p>
                        <?= str_replace(['ORDER_', '_'], ' ', $o->Shipping) ?>
                    </p>
                    <p>
                        <?= str_replace(['ORDER_', '_'], ' ', $o->Shipment) ?>
                    </p>
                    <div class="list__btns">
                        <form method="POST" action="<?= $action->show ?>">
                            <input type="hidden" name="UUID" value="<?= $o->UUID ?>" />
                            <button class="list__button"><i class="fa fa-eye"></i></button>
                        </form>
                        <form method="POST" action="<?= $action->remove ?>">
                            <input type="hidden" name="UUID" value="<?= $o->UUID ?>" />
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
        <div class="export">
            <?= $export ?>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>

</html>