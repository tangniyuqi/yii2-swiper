<?php
/**
 * Swiper
 *
 *@package vendor.tangniyuqi.swiper
 *@author tangming <tangniyuqi@163.com>
 *@copyright DNA <http://www.Noooya.com/>
 *@version 1.0.0
 *@since 2018-04-27 Create
 *@todo N/A
 */
namespace tangniyuqi\swiper;

use yii\helpers\Json;
use yii\web\View;

/**
 * swiper widget
 * @see also http://idangero.us/swiper
 * <?=\tangniyuqi\swiper\Swiper::widget([
 *      'items' => [
 *          Html::img('http://abc.com/1.jpg'),
 *          Html::img('http://abc.com/2.jpg'),
 *          Html::img('http://abc.com/3.jpg'),
 *      ],
 *      'jquery' => false,
 *      'clientOptions' => [
 *          'loop' => true,
 *      ]
 * ]);?>
 */
class Swiper extends \yii\base\Widget
{
    /**
     * @inheritdoc
     */
    public $items = [];

    /**
     * @inheritdoc
     */
    public $jquery = true;

    /**
     * @inheritdoc
     */
    public $pagination = true;

    /**
     * @inheritdoc
     */
    public $navigation = true;

    /**
     * @inheritdoc
     */
    public $scrollbar = false;

    /**
     * @inheritdoc
     */
    public $options = [];

    /**
     * @inheritdoc
     */
    public $clientOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->items)) return null;

        if (!isset($this->options['class'])) {
            $this->options['class'] = 'swiper-container';
        }

        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->id;
        }

        if ($this->pagination) {
            $this->clientOptions['pagination'] = '.swiper-pagination';
        }

        if ($this->navigation) {
            $this->clientOptions['nextButton'] = '.swiper-button-next';
            $this->clientOptions['prevButton'] = '.swiper-button-prev';
        }

        if ($this->scrollbar) {
            $this->clientOptions['scrollbar'] = '.swiper-scrollbar';
        }

        $this->registerAsset();

        $clientOptions = !empty($this->clientOptions)? Json::encode($this->clientOptions): '{}';
        $clientObj = 'swiper'.ucwords($this->options['id']);
        $js = "var {$clientObj}=new Swiper('#{$this->options['id']}', {$clientOptions})";

        $position = $this->jquery? View::POS_READY: View::POS_END;
        $this->view->registerJs($js, $position);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (empty($this->items)) return null;

        return $this->render('swiper');
    }

    /**
     * @inheritdoc
     */
    public function registerAsset()
    {
        $this->jquery? SwiperJqueryAsset::register($this->view): SwiperAsset::register($this->view);
    }
}
