<?php

namespace Halitar\CoreBundle\Controller;

use Halitar\CoreBundle\Controller\Base\BaseController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Description of MainController
 * 
 * @author NDJATHE Julio <jndjathe@halitar.com>
 */
class MainController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('HalitarCoreBundle:Main:index.html.twig');
    }
}
