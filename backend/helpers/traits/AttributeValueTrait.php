<?php
namespace backend\helpers\traits;

trait AttributeValueTrait
{
    public function getAttributeValue( $attribute )
    {
        $attributeName = mb_convert_case($attribute, MB_CASE_TITLE);

        if( strpos($attributeName, '_') !== FALSE ){
            $attributeName = str_replace('_', '', $attributeName);
        }

        $methodName = 'get' . $attributeName . 'Value';
        if( method_exists( $this, $methodName ) ){
            return $this->{$methodName}();
        }

        return $this->{$attribute};
    }
}