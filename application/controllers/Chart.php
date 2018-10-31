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

    /**
     * This function is used to show chart predict one coin
     */
    function showChart($symbol = "ZECETH")
    {
        $this->load->library("rest");
        $result = $this->rest->get("https://api.binance.com/api/v3/ticker/price?symbol=" . $symbol);
        $data = $this->Historical_Price_Predictions_model->getDataForChartCoin($symbol);
        $data->price_actual = explode(",", $data->price_actual);
        $data->price_predict = explode(",", $data->price_predict);
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