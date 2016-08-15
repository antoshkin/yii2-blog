<?php

namespace frontend\controllers;
use common\models\Options;

class ParserController extends \yii\web\Controller
{
    public function actionIndex()
    {

        // -- parse exchange from @cbr.ru
        $xml = new \DOMDocument();
        $url = 'http://www.cbr.ru/scripts/XML_daily.asp';

        if (@$xml->load($url)) {
            $list = [];

            $root = $xml->documentElement;
            $items = $root->getElementsByTagName('Valute');

            foreach ($items as $item)
            {
                $code = $item->getElementsByTagName('CharCode')->item(0)->nodeValue;
                $curs = $item->getElementsByTagName('Value')->item(0)->nodeValue;
                $list[$code] = floatval(str_replace(',', '.', $curs));
            }

        }

        // -- prepare data for cross
        $data['usd-uah'] = $list['USD']/($list['UAH']/10);
        $data['usd-eur'] = $list['USD']/($list['EUR']);
        $data['usd-rur'] = $list['USD'];

        return $this->render('index', ['data' => $data]);
    }

    public function actionResult()
    {

        $data = array();
        $url = $_REQUEST['url'];

        // -- get fixed percent
        $percent = (int)Options::findOne(['option'=>'percent'])->value;

        // -- ebay processing
        if ( false !== strpos( $url, 'ebay.com' ) ) {
            // -- processing
            $content = file_get_contents($url);
            preg_match('/convbidPrice.+>[^\d\.]+([\d\.]+)<span>|notranslate.+>[^\d\.]+([\d\.]+)</',$content,$match);

            if ( isset($match[1]) ) {
                $c = $match[1];
            }

            if ( isset($match[2]) ) {
                $c = $match[2];
            }

            $data['cost'] = $c;
            $data['costfull'] = (float)$c+(float)($c/100)*$percent;
            $data['url'] = $url;

        }
        // -- amazon processing
        elseif ( false !== strpos( $url, 'amazon.com' ) ) {

            // -- processing
            $content = file_get_contents($url);
            preg_match('/priceblock_ourprice.+>[^\d\.]+([\d\.]+)<\/span>/',$content,$match);

            if ( isset($match[1]) ) {
                $data['cost'] = $match[1];
                $data['costfull'] = (float)$match[1]+(float)($match[1]/100)*$percent;
                $data['url'] = $url;
            }
        }
        else {
            $data['error'] = true;
        }



        return $this->render('result', ['data' => $data] );
    }

}