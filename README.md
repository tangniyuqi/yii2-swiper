# yii2-swiper
The swiper slider widget for the Yii framework.

See more here: http://idangero.us/swiper
## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ php composer.phar require tangniyuqi/yii2-swiper
```

or add

```
"tangniyuqi/yii2-swiper": "*"
```

to the `require` section of your `composer.json` file.
## Usage
```php
echo \tangniyuqi\swiper\Swiper::widget([
    'items' => [
        Html::img('http://abc.com/1.jpg'),
        Html::img('http://abc.com/2.jpg'),
        Html::img('http://abc.com/3.jpg'),
    ],
    'clientOptions' => [
        'loop' => true,
    ]
]);
```
