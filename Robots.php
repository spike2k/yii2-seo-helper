<?php
namespace warsztatweb\seo;

class Robots {

    const ROBOTS_INDEX_FOLLOW     = 0;
    const ROBOTS_NOINDEX_NOFOLLOW = 1;
    const ROBOTS_ONLY_NOINDEX     = 2;
    const ROBOTS_ONLY_NOFOLLOW    = 3;


    protected static $_robotsAvailableValues = [
        'index, follow',
        'noindex, nofollow',
        'noindex, follow',
        'index, nofollow'
    ];

    public static function getValues(){
        return static::$_robotsAvailableValues;

    }

    /**
     * Checking for exist value by ID
     *
     * @param integer $id
     * @return bool
     */
    public function idExists($id)
    {
        return (array_key_exists($id, $this->_robotsAvailableValues));
    }


    /**
     * Return value for meta tag by ID
     *
     * @param integer $id
     * @return bool
     */
    public function getPropById($id)
    {
        if(!$this->idExists($id)) return false;
        return $this->_robotsAvailableValues[$id];
    }


    /**
     * Generate content for robots.txt
     */
    public function generateRobotsTxt()
    {
        // ToDo
    }

}