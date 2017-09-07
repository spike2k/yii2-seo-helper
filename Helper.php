<?php

namespace warsztatweb\seo;

/**
 * This is just an example.
 */
class Helper extends \yii\base\Component
{
    public function run()
    {
        return "Hello!";
    }


    public function set($model){

    	print_r($model->attributes);

    }
}
