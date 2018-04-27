<?php
/**
 * SwiperAsset
 *
 *@package vendor.tangniyuqi.laydate
 *@author tangming <tangniyuqi@163.com>
 *@copyright DNA <http://www.Noooya.com/>
 *@version 1.0.0
 *@since 2018-04-27 Create
 *@todo N/A
 */
namespace tangniyuqi\swiper;

class SwiperAsset extends \yii\web\AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@bower/swiper/dist';

    /**
     * @inheritdoc
     */
    public $js = [
        'js/swiper.min.js'
    ];

    /**
     * @inheritdoc
     */
    public $css = [
        'css/swiper.min.css'
    ];
}
