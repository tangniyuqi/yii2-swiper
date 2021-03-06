Yii2 Swiper Widget
==================
- 配置方便

- 同一个界面可以存在多个轮播，且不冲突

- [swiper 4.0 +](http://idangero.us/swiper/)

安装
------------

```
php composer.phar require --prefer-dist tangniyuqi/yii2-swiper "*" -vvv
```

```
"tangniyuqi/yii2-swiper": "*"
```

简单使用
-----
显示轮播

```php
<?php
use yii\helpers\Html;

echo \tangniyuqi\swiper\Swiper::widget([
    'slides' => [
        Html::img('http://abc.com/1.jpg'),
        Html::img('http://abc.com/2.jpg'),
        Html::img('http://abc.com/3.jpg'),
    ],
    'pagination' => true,
    'navigation' => true,
    'scrollbar' => true,
    'clientOptions' => [
        'speed' => 200,
        'loop' => true,
    ]
]);
```

高级使用
-----
自定义操控，自定义js

```php
<?php
use yii\helpers\Html;

//swiper js 初始化后赋值给的变量名
$swiperEl = 'swiper';

echo \tangniyuqi\swiper\Swiper::widget([
    'slides' => [
        Html::img('http://abc.com/1.jpg'),
        Html::img('http://abc.com/2.jpg'),
        Html::img('http://abc.com/3.jpg'),
    ],
    'pagination' => true,
    'navigation' => true,
    'scrollbar' => true,
    'swiperEl' => $swiperEl, // 在此处传入
    'clientOptions' => [
        'speed' => 200,
        'loop' => true,
    ]
]);

//下一个触发按钮
echo Html::button('next', ['id' => 'to-next']);

$js = <<<JS
  //点击之后触发下一个，更多js操作参考官方
  $('#to-next').click(function() {
    {$swiperEl}.slideNext();
  });
JS;

$this->registerJs($js);
```