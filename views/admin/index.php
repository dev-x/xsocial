<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<div class="row wrap" style="padding:20px;padding-top:0px;">
    <h1>Панель адміністрування</h1> 
    <div class='col-sm-12'>
        <?php echo $this->render('menu'); ?>    
    </div>
    <div class='col-sm-12'>
        <h1>Модерація користувачів</h1>
        <div class='col-sm-12'>
                <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <td><b>#</b></td>
                <td><b>Нік-нейм</b></td>
                <td><b>Ім'я</b></td>
                <td><b>Прізвище</b></td>
                <td><b>Належність до групи/кафедри</b></td>
                <td><b>День народження</b></td>
                <td></td>
            </tr>
            <?php // var_dump($kafedra); ?>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user->id;?></td>
                    <td><?= HTML::a($user->username, ['user/show', 'username' => $user->username]) ?></td>
                    <td><?php echo $user->first_name; ?></td>
                    <td><?php echo $user->last_name; ?></td>
                    <td><?php echo $group[$user->group]; echo $kafedra[$user->vnz]; ?></td>
                    <td><?php echo $user->birthday; ?></td>
                    <td><button class='btn btn-default activeted' name='<?= $user->id;?>' data-id='<?= $user->id;?>'>Підтвердити</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
        <div>
            <?php  echo LinkPager::widget(['pagination'=>$pagination]); ?>
        </div>
        </div>
    </div>
    
</div>