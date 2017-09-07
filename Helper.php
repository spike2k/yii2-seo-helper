<?php

namespace warsztatweb\seo;

use Yii;
/**
 * This is just an example.
 */
class Helper extends \yii\base\Component
{

	private $title;
	private $tags;
	private $metadesc;
	private $metakeys;

    public function run()
    {
     	
    }




   public function set($model,$useOnlySEO = false)
   {
    
 		//If model is an array - convert it to object. Default populate columns.

       if(!is_object($model) && is_array($model)){
            $model =(object) $model;
            $model->meta_title = $model->title;
            $model->meta_description = $model->description;
        }

        var_dump($model->attributes);

        //columns where we should search data

        $title_seo_columns = ["meta_title","seo_title","page_title","PR_META_TITLE"];
        $title_additional_columns = ["nazwa", "tytul","tyt","title","name","PR_TYTUL"];
        $description_seo_columns = ["meta_description","seo_description","page_description","PR_META_DESCRIPTION"];
		$description_additional_columns = ["opis","html","lead","content","tresc","txt"];
		$keys_seo_columns = ["meta_keys","seo_keys","page_keywords"];
		$image_additional_columns = ["banner","baner","thumb","foto","image"];


        $meta_title =  $meta_description = $meta_keys = $image = null;
        foreach ($title_seo_columns as $v) if(!empty($model->$v)) {$meta_title = $model->$v;break;}
        foreach ($description_seo_columns as $v) if(!empty($model->$v)) {$meta_description = $model->$v;break;}
        foreach ($keys_seo_columns as $v) if(!empty($model->$v)) {$meta_keys = $model->$v;break;}

        $image = isset($model->params) && is_array($model->params) && !empty($model->params['image'])?$model->params['image']:null;

        

        if(!$useOnlySEO){

            if(!$meta_title){
            	foreach ($title_additional_columns as $v) if(!empty($model->$v)) {$meta_title = $model->$v;break;}
            }
            if(!$meta_description){
            	foreach ($description_additional_columns as $v) if(!empty($model->$v)) {$meta_description = $model->$v;break;}
            }
            if(!$image){
            	foreach ($image_additional_columns as $v) if(!empty($model->$v)) {$image = $model->$v;break;}
            }


        }

        if($meta_title){
             $this->title = $this->tags["og:title"] = $meta_title.(Yii::$app->params['metatitle_suffix']?" - ".Yii::$app->params['metatitle_suffix']:"");
             Yii::$app->controller->view->title = $meta_title;

        } 

        if($meta_description){
        	$meta_description = preg_replace("/{block [a-zA-Z0-9-_]*}/", "", $meta_description);
            $this->metadesc = $this->tags["og:description"] = \yii\helpers\StringHelper::truncate(strip_tags($meta_description),150);
             Yii::$app->controller->view->registerMetaTag(['name' => 'description', 'content' => $this->metadesc]);

        } 

        if($meta_keys){
        	//Disabled for seo reasons. Better do not playe meta keywords.
            //$this->metakeys = strip_tags($meta_keys);
        }         

        if($image) {
            $this->tags["og:image"] = $image;
            if(substr($this->tags["og:image"], 0,4) != 'http') $this->tags["og:image"] = \yii\helpers\Url::to(Yii::getAlias("@web/".$this->tags["og:image"]),true);
        }    
        if(is_array($this->tags)){
            foreach($this->tags AS $tagName=>$tagProp) {
                if(!empty($tagProp) && is_string($tagProp))
                Yii::$app->controller->view->registerMetaTag(['property' => $tagName, 'content' => $tagProp]);
            }        	
        }
        

        
   }
}
