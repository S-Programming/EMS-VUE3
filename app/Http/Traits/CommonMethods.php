<?php

namespace App\Http\Traits;

trait CommonMethods
{
    public function __call($name, $arguments)
    {
        $message = "Please double check as $name is not a defined method";
        /*## Need to verify if it will work or not ##*/
        $this->failureLog("ERROR createCharge", $message, $arguments);
        return array('status' => 'error', 'message' => $message);
    }
}
