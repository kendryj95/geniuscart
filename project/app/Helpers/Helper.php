<?php

namespace App\Helpers;

use DB;

class Helper
{
    public static function slug($slug)
    {
        return strtolower(str_replace(' ','-',$slug));
    }

    public static function buildReferenceCodePayU()
    {
        return "PayU_Payment_" . uniqid() . "_" . strtotime(date('Y-m-d H:i:s'));
    }

    public static function buildSignaturePayU($apiKey, $merchantId, $referenceCode, $amount)
    {
        return md5("$apiKey~$merchantId~$referenceCode~$amount~COP");
    }

    public static function buildDescriptionPayU($products)
    {
        $data = [];
        foreach ($products as $prod) {
            $data[] = $prod['item']['name'] . " " . $prod['qty'];
        }

        return implode(" / ", $data);
    }
}