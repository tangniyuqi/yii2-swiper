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

use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\base\InvalidValueException;

class Swiper extends \yii\base\Widget
{
    /**
     * 层的属性
     * @var array
     */
    public $wrapOptions = [];

    /**
     * 图片是否显示最大宽度
     * @var bool
     */
    public $slideImageFullWidth = true;

    /**
     * swiper js params
     * @link http://idangero.us/swiper/api/
     * @var array
     */
    public $clientOptions = [];

    /**
     * 轮播内容
     * 例如：
     * [
     *      Html::img('http://img.zcool.cn/community/01665258173c34a84a0d304fc68fdf.jpg'),
     *      Html::img('http://img.zcool.cn/community/01665258173c34a84a0d304fc68fdf.jpg'),
     *      Html::img('http://img.zcool.cn/community/01665258173c34a84a0d304fc68fdf.jpg'),
     * ]
     * @var array
     */
    public $slides = [];

    /**
     * 分页器
     * false：不显示
     * true：使用默认值显示
     * array：配置参数 @link http://idangero.us/swiper/api/#pagination
     * @var bool|array
     */
    public $pagination = false;

    /**
     * 左右导航
     * false：不显示
     * true：使用默认值显示
     * array：配置参数 @link http://idangero.us/swiper/api/#navigation
     * @var bool|array
     */
    public $navigation = false;

    /**
     * 底部 scroll 导航
     * false：不显示
     * true：使用默认值显示
     * array：配置参数 @link http://idangero.us/swiper/api/#scrollbar
     * @var bool|array
     */
    public $scrollbar = false;

    /**
     * @var string
     */
    public $swiperEl;

    /**
     * @inheritdoc
     */
    private $_wrapContainerId;

    /**
     * @inheritdoc
     */
    private $_paginationId;

    /**
     * @inheritdoc
     */
    private $_navigationNextId;

    /**
     * @inheritdoc
     */
    private $_navigationPrevId;

    /**
     * @inheritdoc
     */
    private $_scrollbarId;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!$this->slides) {
            throw new InvalidValueException('slides 必须');
        }

        $this->_wrapContainerId = $this->id . '-swiper-container';

        if ($this->pagination) {
            if (!is_array($this->pagination)) {
                $this->pagination = [];
            }

            $this->_paginationId = $this->id . '-swiper-pagination';
            $this->pagination['el'] = '#' . $this->_paginationId;
            $this->clientOptions['pagination'] = $this->pagination;
        }

        if ($this->navigation) {
            if (!is_array($this->navigation)) {
                $this->navigation = [];
            }

            $this->_navigationNextId = $this->id . '-swiper-button-next';
            $this->_navigationPrevId = $this->id . '-swiper-button-prev';
            $this->navigation['nextEl'] = '#' . $this->_navigationNextId;
            $this->navigation['prevEl'] = '#' . $this->_navigationPrevId;
            $this->clientOptions['navigation'] = $this->navigation;
        }

        if ($this->scrollbar) {
            if (!is_array($this->scrollbar)) {
                $this->scrollbar = [];
            }

            $this->_scrollbarId = $this->id . '-swiper-scrollbar';
            $this->scrollbar['el'] = '#' . $this->_scrollbarId;
            $this->clientOptions['scrollbar'] = $this->scrollbar;
        }

        if (!$this->swiperEl) {
            $this->swiperEl = $this->id . 'Swiper';
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $containerContent = [];
        $slideContent = [];

        foreach ($this->slides as $slide) {
            $slideContent[] = Html::tag('div', $slide, ['class' => 'swiper-slide']);
        }

        $containerContent[] = Html::tag('div', implode("\n", $slideContent), ['class' => 'swiper-wrapper']);

        if ($this->pagination) {
            $containerContent[] = Html::tag('div', '', ['id' => $this->_paginationId, 'class' => 'swiper-pagination']);
        }

        if ($this->navigation) {
            $containerContent[] = Html::tag('div', '', ['id' => $this->_navigationPrevId, 'class' => 'swiper-button-prev']);
            $containerContent[] = Html::tag('div', '', ['id' => $this->_navigationNextId, 'class' => 'swiper-button-next']);
        }

        if ($this->scrollbar) {
            $containerContent[] = Html::tag('div', '', ['id' => $this->_scrollbarId, 'class' => 'swiper-scrollbar']);
        }
        Html::addCssClass($this->wrapOptions, 'swiper-container');

        $html = Html::tag('div', implode("\n", $containerContent), array_merge($this->wrapOptions, [
            'id' => $this->_wrapContainerId,
        ]));

        echo $html;

        $this->registerAssets();
    }
    /**
     * 注册资源
     */
    protected function registerAssets()
    {
        SwiperAsset::register($this->view);

        if ($this->slideImageFullWidth) {
            $css = <<<CSS
        #{$this->_wrapContainerId} img {
            width: 100%;
        }
CSS;
            $this->view->registerCss($css);
        }

        $clientOptions = Json::encode2($this->clientOptions);

        $js = new JsExpression("var {$this->swiperEl} = new Swiper('#{$this->_wrapContainerId}', {$clientOptions})");

        $this->view->registerJs($js);
    }
}