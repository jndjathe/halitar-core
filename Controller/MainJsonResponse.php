<?php

namespace Halitar\CoreBundle\Controller;

use Halitar\CoreBundle\Controller\BaseJsonResponse;

/**
 * Description of MainJsonResponse
 *
 * @author NDJATHE Julio <jndjathe@halitar.com>
 */
class MainJsonResponse extends BaseJsonResponse {
    
    /**
     * 
     */
    const ALIAS = 'Func';
    
    /**
     * 
     * 5 secondes
     */
    const TIME = 5;
    
    /**
     * 
     * @param type $selector
     * @param type $attr
     * @param type $val
     * @return type
     */
    public function setAttribute($selector, $attr, $val)
    {
        return $this->addCmd(
            'setAttribute' . self::ALIAS,
            array(
                'selector' => $selector,
                'attr' => $attr,
                'val' => $val
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @param type $attr
     * @return type
     */
    public function removeAttribute($selector, $attr)
    {
        return $this->addCmd(
            'removeAttribute' . self::ALIAS,
            array(
                'selector' => $selector,
                'attr' => $attr,
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @return type
     */
    public function remove($selector)
    {
        return $this->addCmd(
            'remove' . self::ALIAS,
            array(
                'selector' => $selector
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @param type $sEventType
     * @return type
     */
    public function trigger($selector, $sEventType)
    {
        return $this->addCmd(
            'trigger' . self::ALIAS,
            array(
                'selector' => $selector,
                'event' => $sEventType,
            )
        );
    }

    /**
     * 
     * @return type
     */
    public function reload()
    {
        return $this->addCmd('reload' . self::ALIAS);
    }

    /**
     * 
     * @param type $url
     * @return type
     */
    public function redirect($url, $useTimer = false, $time = self::TIME)
    {
        return $this->addCmd(
            'redirect' . self::ALIAS,
            array('url' => $url, 'time' => $time * 1000),
            $useTimer
        );
    }

    /**
     * 
     * @param type $url
     * @return type
     */
    public function redirectBlank($url)
    {
        return $this->addCmd(
            'redirectBlank' . self::ALIAS,
            array(
                'url' => $url
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @param type $content
     * @return type
     */
    public function replaceContent($selector, $content = '')
    {
        return $this->addCmd(
            'replaceContent' . self::ALIAS,
            array(
                'selector' => $selector,
                'content' => $content,
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @param type $content
     * @return type
     */
    public function temporaryContent($selector, $content = '')
    {
        return $this->addCmd(
            'temporaryContent' . self::ALIAS,
            array(
                'selector' => $selector,
                'content' => $content,
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @param type $content
     * @return type
     */
    public function before($selector, $content)
    {
        return $this->addCmd(
            'addBefore' . self::ALIAS,
            array(
                'selector' => $selector,
                'content' => $content,
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @param type $content
     * @return type
     */
    public function after($selector, $content)
    {
        return $this->addCmd(
            'addAfter' . self::ALIAS,
            array(
                'selector' => $selector,
                'content' => $content,
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @param type $className
     * @return type
     */
    public function addClass($selector, $className)
    {
        return $this->addCmd(
            'addClass' . self::ALIAS,
            array(
                'selector' => $selector,
                'className' => $className,
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @param type $className
     * @return type
     */
    public function removeClass($selector, $className)
    {
        return $this->addCmd(
            'removeClass' . self::ALIAS,
            array(
                'selector' => $selector,
                'className' => $className,
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @return type
     */
    public function show($selector)
    {
        return $this->addCmd(
            'show' . self::ALIAS,
            array(
                'selector' => $selector
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @return type
     */
    public function hide($selector)
    {
        return $this->addCmd(
            'hide' . self::ALIAS,
            array(
                'selector' => $selector
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @return type
     */
    public function enabled($selector)
    {
        return $this->addCmd(
            'enabled' . self::ALIAS,
            array(
                'selector' => $selector
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @return type
     */
    public function disabled($selector)
    {
        return $this->addCmd(
            'disabled' . self::ALIAS,
            array(
                'selector' => $selector
            )
        );
    }

    /**
     * 
     * @param type $msg
     * @return type
     */
    public function alert($msg)
    {
        return $this->addCmd(
            'alert' . self::ALIAS,
            array('msg' => $msg)
        );
    }

    /**
     * 
     * @param type $msg
     * @return type
     */
    public function consoleLog($msg)
    {
        return $this->addCmd(
            'consoleLog' . self::ALIAS,
            array(
                'msg' => $msg
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @param type $value
     * @return type
     */
    public function setVal($selector, $value)
    {
        return $this->addCmd(
            'setVal' . self::ALIAS,
            array(
                'selector' => $selector,
                'value' => $value,
            )
        );
    }

    /**
     * 
     * @param type $alert
     * @param type $title
     * @return type
     */
    public function openErrorBox($alert, $title = 'Erreur')
    {
        return $this->addCmd(
            'openAlertBox' . self::ALIAS,
            array(
                'title' => $title,
                'alertMsg' => $alert,
                'alertType' => 'error',
            )
        );
    }

    /**
     * 
     * @param type $alert
     * @param type $title
     * @return type
     */
    public function openSuccessBox($alert, $title = 'Succès')
    {
        return $this->addCmd(
            'openAlertBox' . self::ALIAS,
            array(
                'title' => $title,
                'alertMsg' => $alert,
                'alertType' => 'success',
            )
        );
    }

    /**
     * 
     * @param type $alert
     * @param type $title
     * @return type
     */
    public function openInfoBox($alert, $title = 'Information')
    {
        return $this->addCmd(
            'openAlertBox' . self::ALIAS,
            array(
                'title' => $title,
                'alertMsg' => $alert,
                'alertType' => 'info',
            )
        );
    }

    /**
     * 
     * @return type
     */
    public function openLoadingBox()
    {
        return $this->addCmd('openLoadingBox' . self::ALIAS);
    }

    /**
     * 
     * @return type
     */
    public function closeLoadingBox()
    {
        return $this->addCmd('closeLoadingBox' . self::ALIAS);
    }

    /**
     * 
     * @param type $selector
     * @return type
     */
    public function startSpinner($selector)
    {
        return $this->addCmd(
            'startSpinner' . self::ALIAS,
            array(
                'selector' => $selector,
            )
        );
    }

    /**
     * 
     * @param type $selector
     * @return type
     */
    public function stopSpinner($selector)
    {
        return $this->addCmd(
            'stopSpinner' . self::ALIAS,
            array(
                'selector' => $selector,
            )
        );
    }

    /**
     * 
     * @param array $data
     * @return type
     */
    public function ajax(array $data)
    {
        return $this->addCmd('ajax' . self::ALIAS, $data);
    }

    /**
     * 
     * @param array $data
     * @return type
     */
    public function openFormErrorBox(array $data)
    {
        return $this->addCmd('openAlertBox' . self::ALIAS, $data);
    }

    /**
     * 
     * @param array $data
     * @return type
     */
    public function openConfirmBox(array $data)
    {
        return $this->addCmd('openConfirmBox' . self::ALIAS, $data);
    }  
    
}
