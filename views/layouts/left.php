<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->session->get('fio') ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    ['label' => 'Склады', 'icon' => 'angle-double-right', 'url' => ['/store']],
                    ['label' => 'Продукты', 'icon' => 'angle-double-right', 'url' => ['/product']],
                    ['label' => 'API', 'icon' => 'angle-double-right', 'url' => ['/api/get-products']],
                ],
            ]
        ) ?>

    </section>

</aside>
