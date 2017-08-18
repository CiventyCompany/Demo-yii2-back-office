<?php
namespace backend\helpers;

use Yii;

class TokenHelper
{
    public static function show( $tokens )
    {
        $out = '';
        if( is_array($tokens) ){
            $out .= '<div class="tokens-list-wrap"><h3>' . Yii::t('app', 'Tokens') . '</h3><ul class="tokens-list">';
            foreach ($tokens as $token => $description){
                $out .= '<li>[' . $token . '] - ' . $description . '</li>';
            }
            $out .= '</ul></div>';
        }
        return $out;
    }
}