<?php

namespace SmartDelivery\Main\Utils\Money;

class JsonUtil
{
    public static function safeFloat(string $json): string
    {
        $regexp = '/"(\s*)\:(\s*)(\-?\d+([eE][\+|\-]?\d+|\.\d+)+)(\s*[,(\s*)|\}])/';
        $jsonString = preg_replace($regexp, "\"$1:$2\"$3\"$5", $json);

        if ($jsonString === null) {
            $message = 'An error occurred when converting a json string';
            trigger_error($message, E_USER_WARNING);
            return $json;
        }

        return $jsonString;
    }
}
