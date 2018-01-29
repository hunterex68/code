<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.12.2016
 * Time: 12:41
 */

namespace common\models;

use Yii;
use common\components\BaseUtilites;


class Log
{
    /**
     * @param $msg
     * @param bool|false $append
     * @param null $filename
     * @return bool
     */
    static public function toFile($msg, $append = false, $filename = null){
        if(empty($filename)){
            $filename = BaseUtilites::settings('TEMP_LOG_FILENAME');
        }
        return self::writeToFile($msg, $append, $filename);
    }


    /**
     * @param $msg
     * @param bool|true $append
     * @param string $filename
     */
    public static function toGlobalLog($msg, $append = true, $filename = 'global_log.txt') {
        if (BaseUtilites::settings('GLOBAL_LOG_ENABLE')) {
            self::writeToFile($msg, $append, $filename);
        }
    }


    /**
     * @param $msg
     * @param bool|false $append
     * @param null $filename
     * @return bool
     */
    private static function writeToFile($msg, $append = false, $filename = null){
        if(empty($filename)){
            $filename = BaseUtilites::settings('TEMP_LOG_FILENAME');
        }
        if (!BaseUtilites::settings('TEMP_LOG_ENABLE') && $filename == BaseUtilites::settings('TEMP_LOG_FILENAME')){
            return true;
        }

        $mode = ($append) ? "a+" : "w+";
        $dir = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'logs';
        $file = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $filename;

        $ret =  false;
        if(is_dir($dir) && ((file_exists($file) && is_writable($file))
				|| (!file_exists($file) && is_writable(Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR))) ){
            set_error_handler(function ($errno, $errstr, $errfile, $errline){
                throw new \Exception($errstr, $errno);
            }, E_ALL);
            try{
                $handler = @fopen($dir.DIRECTORY_SEPARATOR.$filename,$mode);
            }  catch (\Exception $e){
                return false;
            }
            restore_error_handler();

            if(is_object($msg) || is_array($msg)){
                ob_start();
                print_r($msg);
                $msg = ob_get_clean();
            }
            $ret = fwrite($handler,$msg."\n") !== false;
            fclose($handler);
        }
        return $ret;

    }


    /**
     * @param $obj
     */
    static public function printR($obj){
        if(BaseUtilites::settings('PRODUCTION_MODE')){
            return;
        }
        echo "<pre>";
        print_r($obj);
        echo "</pre>";
    }


    /**
     * reorder fields in array similar to old project
     *
     * @param array $dataList
     * @return array
     */
    public static function reorderTransactionData($dataList = []){
        $transactionList = [
            'r' => '',
            'id_transaction' => '',
            'bruce_obj_id' => '',
            'WCOPayrollKey' => '',
            'id_event' => '',
            'id_crew' => '',
            'id_location' => '',
            'ev_name' => '',
            'ev_id_office' => '',
            'ev_id_client' => '',
            'ev_gift_source' => '',
            'add_date_transaction' => '',
            'id_user' => '',
            'id_user_delegate' => '',
            'delegate_media' => '',
            'id_medium' => '',
            'tr_guid' => '',
            'u_LoginUserID' => '',
            'u_FirstName' => '',
            'u_LastName' => '',
            'u_Phone' => '',
            'o_name' => '',
            'o_id' => '',
            'o_country_code' => '',
            'o_state_code' => '',
            'o_id_city' => '',
            'o_time_zone' => '',
            'status_transaction' => '',
            'status_owner' => '',
            'plan_canada_terminal_payment' => '',
            'plan_canada_ChildID' => '',
            'resource_gift' => '',
            'gift_type_name' => '',
            'gs_countryCode' => '',
            'gs_stateCode' => '',
            'gs_id_city' => '',
            'gs_cityName' => '',
            'gs_key' => '',
            'sponsor_title' => '',
            'sponsor_title_id' => '',
            'sponsor_name_first' => '',
            'initial' => '',
            'sponsor_name_last' => '',
            'custom_field1' => '',
            'custom_label1' => '',
            'custom_field2' => '',
            'custom_label2' => '',
            'custom_field3' => '',
            'custom_label3' => '',
            'custom_field4' => '',
            'custom_label4' => '',
            'custom_field5' => '',
            'custom_label5' => '',
            'custom_field6' => '',
            'custom_label6' => '',
            'custom_field7' => '',
            'custom_label7' => '',
            'billing_name_first' => '',
            'billing_name_last' => '',
            'donor_email' => '',
            'billing_address_street1' => '',
            'billing_address_street1_form' => '',
            'billing_address_apt_type' => '',
            'billing_address_apt' => '',
            'billing_address_street2' => '',
            'billing_address_city' => '',
            'billing_address_city_name' => '',
            'billing_address_state' => '',
            'billing_address_state_name' => '',
            'billing_address_zip' => '',
            'billing_address_country' => '',
            'billing_address_country_name' => '',
            'billing_apt_verified' => '',
            'billing_address_building_number' => '',
            'billing_address_sub_building_number' => '',
            'billing_address_state_name_fr' => '',
            'billing_address_po_box_number' => '',
            'delivery_inst_type_qualifier_name' => '',
            'billing_address_dpid' => '',
            'building_level_type' => '',
            'building_level_number' => '',
            'email_opt_out' => '',
            'mail_opt_out' => '',
            'phone_opt_out' => '',
            'sms_opt_out' => '',
            'phone' => '',
            'phone_type' => '',
            'phone_status' => '',
            'phone2' => '',
            'phone2_type' => '',
            'phone2_status' => '',
            'phone3' => '',
            'phone3_type' => '',
            'phone3_status' => '',
            'year_of_birth' => '',
            'month_of_birth' => '',
            'day_of_birth' => '',
            'gift_type' => '',
            'recurring' => '',
            'other_amount' => '',
            'startup_gift_amount' => '',
            'birth_min' => '',
            'card_type' => '',
            'card_number' => '',
            'card_exp_date_month' => '',
            'card_exp_date_year' => '',
            'card_cvv' => '',
            'payment_method' => '',
            'cheque_image' => '',
            'best_time_callback' => '',
            'best_date_callback' => '',
            'id_first' => '',
            'id_stats' => '',
            'id_client' => '',
            'cl_name' => '',
            'cl_id_option' => '',
            'cl_id_donation' => '',
            'counter_payment' => '',
            'processorRefId' => '',
            'saleid' => '',
            'is_active' => '',
            'last_update' => '',
            'hpci_report_exclude' => '',
            'hpci_report_counter' => '',
            'WCO_import_status' => '',
            'WCO_import_timestamp' => '',
            'WCO_import_donationid' => '',
            'id_report' => '',
            'skynet_transmitted' => '',
            'billing_address_verified' => '',
            'preferred_language' => '',
            'child' => '',
            'id_swipetrack' => '',
            'address_search' => '',
            'bin' => '',
            'bin_type' => '',
            'donor_confirmed' => '',
            'latitude' => '',
            'longitude' => '',
            'is_verified' => '',
            'verified_datetime' => '',
            'verified_by' => '',
            'canvasser_location' => '',
            'callback_status' => '',
            'canvass_cross_street1' => '',
            'canvass_cross_street2' => '',
            'canvass_city' => '',
            'canvass_neighbourhood' => '',
            'user_name' => '',
            'user_delegate_name' => '',
            'display_add_date_transaction' => '',
            'display_last_update' => '',
            'notes' => '',
            'gift_type_amount_range' => '',
            'fake_email' => '',
            'credit_card_payment' => '',
            'direct_debit_payment' => '',
            'tr_type' => '',
            'bank_name' => '',
            'institution_id' => '',
            'transit_number' => '',
            'account_number' => '',
            'account_type' => '',
        ];
        foreach($transactionList as $key => $val ) {
            if(isset($dataList[$key])){
                $transactionList[$key] = $dataList[$key];
            }
        }
        return $transactionList;
    }
}