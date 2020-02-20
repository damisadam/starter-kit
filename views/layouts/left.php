<?php
use yii\helpers\Html;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo (Yii::$app->user->isGuest)?"": Yii::$app->user->identity->full_name?></p>
                <?php if(!Yii::$app->user->isGuest){ ?>
                <i class="fa fa-circle text-success "> Online</i>
                <?php }else{ ?>
                    <i class="fa fa-circle text-success text-red"> Offline</i>
               <?php } ?>
            </div>
        </div>

        <!-- search form -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Dashboard', 'options' => ['class' => 'header']],
                    ['label' => 'Home','icon' => 'dashboard', 'url' => ['/site/index']],
                    ['label' => 'A', 'icon' => 'file-code-o', 'url' => ['/a']],
                    /*['label' => 'B', 'icon' => 'users', 'url' => ['/b']],
                    ['label' => 'C', 'icon' => 'users', 'url' => ['/c']],
                    ['label' => 'C', 'icon' => 'dashboard', 'url' => ['/s']],*/
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                ],
            ]
        ) ?>

    </section>

</aside>
