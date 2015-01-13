<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<div class="row wrap" style="padding:20px;">
    <h1>Користувачі</h1>
    <table class="table table-striped table-hover">
    <tbody>
        <tr>
            <td><b>#</b></td>
            <td><b>Нік-нейм</b></td>
            <td><b>Ім'я</b></td>
            <td><b>Прізвище</b></td>
            <td><b>Кількість блогів</b></td>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user->id;?></td>
                <td><?= HTML::a($user->username, ['user/show', 'username' => $user->username]) ?></td>
                <td><?php echo $user->first_name?></td>
                <td><?php echo $user->last_name?></td>
                <td><?php echo $user->pcount;?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
    <div>
        <?php  echo LinkPager::widget(['pagination'=>$pagination]); ?>
    </div>
</div>