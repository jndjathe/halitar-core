<?php

namespace Halitar\CoreBundle\Controller\Base;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\HttpFoundation\Request;
use AppKernel;

use Halitar\CoreBundle\Tool\FrontKeySession;
use Halitar\CoreBundle\Tool\ViewTool;

/**
 * Description of BaseController
 *
 * @author NDJATHE Julio <dev@halitar.com>
 */
class BaseController extends Controller {
    
    const THUMB_FILE_PREFIX = 'thumb_';
    const CHARSET = 'UTF-8';

    /**
     * 
     * @return Symfony\Component\Security\Core\SecurityContext
     */
    public function getSecurity() {
        
        return $this->get('security.context');
    }
    
    /**
     * 
     * @return Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken
     */
    public function getToken() {
        
        return $this->getSecurity()->getToken();
    }

    /**
     * 
     * @return Symfony\Component\Security\Core\User\User
     */
    public function getUserConnected() {
        
        return $this->getToken() != null ? $this->getToken()->getUser() : null;
    }

    /**
     * Retourne la class du controller courrant
     * 
     * @return type
     */
    public function getController() {
        
        return get_class($this);
    }
    
    /**
     * 
     * @return type
     */
    public function getSession() {
        
        return $this->get('session');
    }
    
    /**
     * 
     * @param type $key
     * @param type $value
     */
    public function hasOnSession($key) {
        
        return $this->getSession()->has($key);
    }    
    
    /**
     * 
     * @param type $key
     * @param type $value
     */
    public function addOnSession($key, $value) {
        
        $this->getSession()->set($key, $value);
    }
    
    /**
     * 
     * @param type $key
     */
    public function getOnSession($key) {
        
        return $this->getSession()->get($key);
    }
    
    /**
     * 
     * @param type $key
     * @return type
     */
    public function removeOnSession($key) {
        
        return $this->getSession()->remove($key);
    }   
    
    /**
     * 
     */
    public function clearAllSession() {
        
        return $this->getSession()->clear();
    }       

    /**
     * Add a flash notice
     *
     * @param string $sText
     * @param string $sName
     */
    public function addFlashNotice($sText, $sName = 'notice')
    {
        $this->getSession()->getFlashBag()->add($sName, $sText);
    }
    
    /**
     * Add a flash notice
     *
     * @param string $sText
     */
    public function addFlashSucces($sText)
    {
        $this->addFlashNotice($sText, 'succes');
    }    
    
    /**
     * Add a flash notice
     *
     * @param string $sText
     */
    public function addFlashError($sText)
    {
        $this->addFlashNotice($sText, 'error');
    }      

    /**
     * Get container parameter
     *
     * @param  string $sName
     * @return string
     */
    public function getParameter($sName)
    {
        return $this->container->getParameter($sName);
    }
    
    /**
     * 
     * @return DataCollectorTranslator
     */
    public function getTranslator() {
        
        return $this->get('translator');
    }
    
    /**
     * 
     * @return type
     */
    protected function getAssets() {
        
        return $this->container->get('templating.helper.assets');
    }

    /**
     * 
     * @param type $path
     * @return type
     */
    protected function getAssetsUrl($path) {
        
        return $this->getAssets()->getUrl($path, null);
    }

    /**
     * 
     * @return \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface
     */
    protected function getTemplating() {
        
        return $this->container->get('templating');
    }
    
    /**
     * 
     * @param type $value
     * @return type
     */
    protected function escape($value) {
        
        return htmlspecialchars($value, ENT_QUOTES, BaseController::CHARSET , false);
    }

    /**
     * Traduction
     * 
     * @param type $msg
     * @param type $param
     * @return type
     */
    public function traduire($msg, $param = array()) {
        
        return $this->getTranslator()->trans($msg, $param);
    } 
    
    /**
     * 
     * @param type $name
     */
    public function saveNavigationHistory($name) {

        $link = $_SERVER['REQUEST_URI'];
                        
        /**
         * Sauvegarde des liens
         */
        if (!$this->hasOnSession(FrontKeySession::NAVIGATION_HISTORY_LINK)) {
            
            $this->addOnSession(FrontKeySession::NAVIGATION_HISTORY_LINK, array());
        }

        $linksSave = $this->getOnSession(FrontKeySession::NAVIGATION_HISTORY_LINK);

        /**
         * Sauvegarde des liens et nom des liens
         */
        if (!$this->hasOnSession(FrontKeySession::NAVIGATION_HISTORY)) {
            
            $this->addOnSession(FrontKeySession::NAVIGATION_HISTORY, array());
        }

        $navigationHistory = $this->getOnSession(FrontKeySession::NAVIGATION_HISTORY);
        
        if (!in_array($link, $linksSave)) {
            
            $navigationHistory[] = array('link' => $link, 'name' => $name);
            
            $linksSave[] = $link;
            $this->addOnSession(FrontKeySession::NAVIGATION_HISTORY_LINK, $linksSave);
        }

        $this->addOnSession(FrontKeySession::NAVIGATION_HISTORY, $navigationHistory);
    }
    
    /**
     * 
     * @param Request $request
     * @return int
     */
    public function getPageNumber(Request $request) {
        
        $page = $request->get('p');

        if (is_null($page)) {
            
            $page = 1;
        }
        
        return $page;
    }
    
    /**
     * 
     * @param type $string
     * @return type
     */
    public function slugify($string) {
        
        return ViewTool::slugify($string);
    }
    
    /**
     * 
     * @return type
     */
    public function getUploadsFolder() {
        
        return $this->get('kernel')->getRootDir() . '/../web/uploads' . DIRECTORY_SEPARATOR;
    }
    
    /**
     * 
     * @return type
     */
    protected function getLocalFile($file) {
        
        return $this->get('kernel')->getRootDir() . '/../web/uploads' . DIRECTORY_SEPARATOR . $file;
    }    
    
    /**
     * 
     * @return type
     */
    public function getRandomStr() {
        
        return substr( md5(rand()), 0, 10);
    }    
    
    /**
     * 
     * @param type $file
     * @return type
     */
    public function getRandomFileName($file) {
        
        $array = explode('.', $file);
        
        return $this->getRandomStr() . '.' . end($array);
    }
    
    /**
     * 
     * @return AppKernel
     */
    public function getKernel() {
        
        return  $this->get('kernel');
    }
    
    /**
     * 
     * @return type
     */
    public function getEnvironment() {
        
        return $this->getKernel()->getEnvironment();
    }
    
    /**
     * 
     * @return type
     */
    public function isDevEnvironment() {
        
        return ($this->getEnvironment() == 'dev');
    } 
    
    /**
     * 
     * @param array $data
     */
    protected function sendMail(array $data) { 
        
        if($this->isDevEnvironment()) {
            
            // En mode administrateur, aucun mail n'est envoye aux clients
           $this->senderModeDev($data);
        }
                
        return $this->sendMailSwift($data);
    } 
    
    /**
     * 
     * @param type $data
     */
    private function senderModeDev(&$data) {
                
        if(isset($data['to'])) {
            
            $data['to'] = $this->getParameter('jobinfo_mail_tester');
        }
                
        if(isset($data['replyTo'])) {
            
            // repondre a
            $data['replyTo'] = $this->getParameter('jobinfo_mail_tester');
        }
                
        if(isset($data['cc'])) {
            
            $data['cc'] =  $this->getParameter('jobinfo_mail_tester');
        }
        
        if(isset($data['bcc'])) {
            
            $data['bcc'] =  $this->getParameter('jobinfo_mail_tester');
        }        
        
    }

    /**
     * 
     * @param array $data
     */
    protected function sendMailPHPMailer(array $data) { 
        
        $mailer = $this->mailerPHPMailer();
        
        $mailer->setFrom($this->getParameter('jobinfo_mail'));

        $mailer->addReplyTo($data['to']);

        $mailer->Subject = $data['subject'];

        $mailer->msgHTML($data['body']);
        
        if (isset($data['docs'])) {
            foreach ($data['docs'] as $doc) {
                $mailer->addAttachment($doc);
            }
        }

        if(isset($data['cc'])) {
            $mailer->addCC($data['cc']);
        }
        
        if(isset($data['replyTo'])) {
            $mailer->addReplyTo($data['replyTo']);
        }
        
        if(isset($data['bcc'])) {
            $mailer->addBCC($data['bcc']);
        }

        if ($this->getParameter('actif_send_mail')) {
            return $mailer->send();
        }
        
        return 0;
    }
    
    /**
     * 
     * @return \PHPMailer
     */
    private function mailerPHPMailer() {
                
        date_default_timezone_set('Etc/UTC');
        
        $mailer = new \PHPMailer();
                
        $mailer->isSMTP();

        $mailer->CharSet = self::CHARSET;
        
        $mailer->Mailer = 'smtp';
        
        $mailer->SMTPDebug = 2;

        $mailer->Debugoutput = 'html';

        $mailer->Host = 'smtp.gmail.com';

        $mailer->Port = 465;

        $mailer->SMTPSecure = 'ssl';

        $mailer->SMTPAuth = true;

        $mailer->Username = $this->getParameter('mailer_user');

        $mailer->Password = $this->getParameter('mailer_password');      
        
        return $mailer;
    }    
    
    /**
     * 
     * @param array $data
     */
    protected function sendMailSwift(array $data) {
                
        $message = \Swift_Message::newInstance();
        
        $message->setSubject($data['subject'])
                ->setFrom($this->getParameter('jobinfo_mail'))
                ->setTo($data['to'])
                ->setBody($data['body'], 'text/html', self::CHARSET);
                
        if(isset($data['replyTo'])) {
            // repondre a
            $message->setReplyTo($data['replyTo']);
        }
                
        if(isset($data['cc'])) {
            $message->setCc($data['cc']);
        }
        
        if(isset($data['bcc'])) {
            $message->setBcc($data['bcc']);
        }
        
        if (isset($data['docs'])) {
            foreach ($data['docs'] as $doc) {
                $message->attach(\Swift_Attachment::fromPath($doc));
            }
        }

        if($this->getParameter('actif_send_mail')) {
            return $this->mailerSwift()->send($message);
        }
        
        return 0;
    }
    
    /**
     * 
     * @return \Swift_Mailer
     */
    private function mailerSwift() {
        
        $user = $this->getParameter('mailer_user');
        $password = $this->getParameter('mailer_password');
                                
        $transporter = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                                            ->setUsername($user)
                                            ->setPassword($password);       
        
        return \Swift_Mailer::newInstance($transporter);
    }
    
    /**
     * 
     * @return string
     */
    function getClientIpEenv() {

        $ipaddress = '';

        if (getenv('HTTP_CLIENT_IP')) {
            
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('HTTP_X_FORWARDED')) {
            
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if (getenv('HTTP_FORWARDED_FOR')) {
            
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if (getenv('HTTP_FORWARDED')) {
            
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if (getenv('REMOTE_ADDR')) {
            
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }
    
    /**
     * 
     * @return string
     */
    function getClientIpServer() {

        $ipaddress = '';

        if ($_SERVER['HTTP_CLIENT_IP']) {
            
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if ($_SERVER['HTTP_X_FORWARDED_FOR']) {
            
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if ($_SERVER['HTTP_X_FORWARDED']) {
            
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if ($_SERVER['HTTP_FORWARDED_FOR']) {
            
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if ($_SERVER['HTTP_FORWARDED']) {
            
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if ($_SERVER['REMOTE_ADDR']) {
            
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }
    
    /**
     * Boolean permettant d'afficher une pub locale ou google
     * 
     * @return type
     */
    protected function showLocalPub() {

        $rand = mt_rand(0, 10);

        return $rand > 5;
    }
    
    /**
     * 
     * @return \Halitar\CoreBundle\Manager\BaseManager
     */
    public function getManagerBase() {
        
        return $this->get('halitar.base.manager');
    }

}
