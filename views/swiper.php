<?php
use yii\helpers\Html;

$context = $this->context;
?>

<?php Html::beginTag('div', $context->options);?>
    <div class="swiper-wrapper">
        <?php foreach ($context->items as $item) {?>
            <div class="swiper-slide"><?php echo $item?></div>
        <?php }?>
    </div>

    <?php if ($context->pagination) {?>
        <div class="swiper-pagination"></div>
    <?php }?>

    <?php if ($context->navigation) {?>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    <?php }?>

    <?php if ($context->scrollbar) {?>
        <div class="swiper-scrollbar"></div>
    <?php }?>
<?php Html::endTag('div');?>
