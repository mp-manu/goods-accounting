<?php


namespace app\controllers;


use app\models\Product;
use app\models\StoreProduct;
use yii\web\Controller;
use yii\web\Response;

class ApiController  extends Controller
{
    public function actionGetProducts():Response{
        $xml = $this->generateProduct();
        return \Yii::$app->response->sendContentAsFile($xml, 'products.xml', [
            'mimeType' => 'application/xml',
            'inline' => true,
        ]);
    }

    public function generateProduct(){
        ob_start();

        $products = Product::find()->all();


        $writer = new \XMLWriter();
        $writer->openURI('php://output');
        $writer->startDocument('1.0', 'UTF-8');
        $writer->startDTD('yml_catalog SYSTEM "shops.dtd"');
        $writer->endDTD();
        $writer->startElement('data');
            $writer->startElement('product');
                foreach ($products as $product){
                    $writer->startElement('name');
                        $writer->text($product->name);
                    $writer->endElement();
                    $writer->startElement('description');
                        $writer->text($product->description);
                    $writer->endElement();
                    $product_details = $product->getDetails();
                    if(!empty($product_details)){
                        $writer->startElement('prices');
                        foreach ($product_details as $detail){
                            $writer->startElement('price');

                            $writer->startElement('stock_code');
                                $writer->text($detail->store_code);
                            $writer->endElement();

                            $writer->startElement('stock_name');
                                $writer->text($detail->storeCode->name);
                            $writer->endElement();

                            $writer->startElement('price');
                                $writer->text($detail->price);
                            $writer->endElement();

                            $writer->endElement();
                        }
                        $writer->endElement();
                    }

                }
            $writer->endElement();
        $writer->endElement();
        $writer->fullEndElement();

        $writer->endDocument();
        return ob_get_clean();
    }
}