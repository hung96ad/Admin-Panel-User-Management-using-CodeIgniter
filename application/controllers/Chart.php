<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
/**
 * Created by PhpStorm.
 * User: hungnt
 * Date: 31/10/2018
 * Time: 12:08
 */
class Chart extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->model('Historical_Price_Predictions_model');
    }

    function sign( $number ) {
        return ( $number > 0 ) ? 1 : ( ( $number < 0 ) ? -1 : 0 );
    }

    /**
     * This function is used to show chart predict one coin
     */
    function showChart($symbol = "ZECETH")
    {
        $this->load->library("rest");
        $result = $this->rest->get("https://api.binance.com/api/v3/ticker/price?symbol=" . $symbol);
        $data = $this->Historical_Price_Predictions_model->getDataForChartCoin($symbol);
        $data->price_actual = preg_replace("/[^0-9,.]/", "", $data->price_actual);
        $data->price_predict = preg_replace("/[^0-9,.]/", "", $data->price_predict);
        $data->price_actual = explode(",", $data->price_actual);
        $data->price_predict = explode(",", $data->price_predict);
        $len = count($data->price_predict) - 1;
        $error_trend = 0;
        $sum_mse = 0;
        $sum_actual = 0;
        for($i = 0; $i< $len ; $i++){
            $sum_actual += $data->price_actual[$i];
            $sum_mse += sqrt(pow(floatval($data->price_predict[$i]) - floatval($data->price_actual[$i+1]), 2));
            $sign_predict = $this->sign(floatval($data->price_predict[$i]) - floatval($data->price_actual[$i+1]));
            $sign_actual = $this->sign(floatval($data->price_actual[$i+1]) - floatval($data->price_actual[$i]));
            if ($sign_actual == $sign_predict){
                $error_trend += 1;
            }
        }
        $data->relative_error = round($sum_mse / $sum_actual * 100, 2);
        $data->per_err_trend = round($error_trend / $len * 100, 2);
        $data->price = $result->price;
        $data->symbol = $symbol;
        $this->global['pageTitle'] = "Chart " . $symbol;
        $this->loadViews("chart", $this->global, $data, NULL);
    }

    /**
     * This function is used to show table predict price coin
     */
    function showTablePredict()
    {
        $data['datatable'] = $this->Historical_Price_Predictions_model->getDataPredict();
        $this->global['pageTitle'] = "Predict price coin" ;
        $this->loadViews("dashboard", $this->global, $data, NULL);
    }

}
?>