<?php

namespace Halitar\CoreBundle\Tool;

use Cocur\Slugify\Slugify;

/**
 * Description of ViewTool
 *
 * @author NDJATHE Julio <jndjathe@halitar.com>
 */
class ViewTool {

    /**
     * 
     * @param type $string
     * @return type
     */
    public static function slugify($string) {
        
        $slugify = new Slugify();

        return $slugify->slugify($string);
    }

    /**
     * 
     * @param type $string
     * @return type
     */
    public static function escaping($string) {
        
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

}
