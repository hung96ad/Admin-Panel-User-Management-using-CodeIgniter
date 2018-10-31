<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: hungnt
 * Date: 31/10/2018
 * Time: 01:24
 */

class Historical_Price_Predictions_model extends CI_Model
{
    function getDataForChartCoin($symbol)
    {
        $sql =    'SELECT 	REPLACE(REPLACE(h.price_actual,"[",""),"]","") price_actual,
	                    REPLACE(REPLACE(h.price_predict,"[",""),"]","") price_predict,
                        c.symbol,
                        ht.openTime_last
                    FROM historical_price_predictions h
                    JOIN coin_info c ON h.id_coin = c.id
                        AND c.symbol = ?
                    JOIN (SELECT id_coin, 
                            MAX(openTime_last) openTime_last 
                          FROM historical_train 
                          GROUP BY id_coin) AS ht
                    ON ht.id_coin = c.id
                    ORDER BY h.id DESC
                    LIMIT 1';
        $query = $this->db->query($sql, $symbol);
        $result = $query->first_row();
        return $result;
    }

    function  getDataPredict()
    {
        $sql = 'SELECT a.*, c.symbol
                FROM (SELECT h.id_coin,
                        ROUND(((price_preidct_last / price_predict_previous) - 1) * 100, 2) AS percent_predict,
                        ROUND(((price_predict_previous / price_actual_last) - 1) * 100, 2) AS percent_predict_actual,
                        ROUND(((price_preidct_last / price_actual_last) - 1) * 100, 2) AS percent_predict_actual_last,
                        ROUND(((price_actual_last / price_actual_previous) - 1) * 100, 2) AS percent_actual,
                        ROUND(price_preidct_last, 8) price_preidct_last,
                        ROUND(price_preidct_last - (price_predict_previous - price_actual_last), 8) price_preidct_true,
                        FROM_UNIXTIME(h.time_create) time_predict
                    FROM historical_price_predictions AS h
                    WHERE time_create > UNIX_TIMESTAMP(NOW()) - 30 * 60
                    ORDER BY percent_predict DESC
                    ) AS a
                JOIN coin_info c ON a.id_coin = c.id';
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
}

?>