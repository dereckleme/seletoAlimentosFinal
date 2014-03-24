<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProdutoController extends AbstractActionController
{
    public function indexAction()
    {
        $this->redirect()->toRoute("home");
    }
    
    public function pageAction()
    {
    	$page = $this->params()->fromRoute('pagina',0);
    	$permissao = $this->getServiceLocator()->get('Application\Controller\Produto');
    	if(in_array($page,$permissao['views_layout']))
    	{    		
    		$view = new ViewModel();
    		$view->setTemplate('application/produto/'.$page.'.phtml');
    		return $view;
    	}
    	else 
    	{
    		$this->redirect()->toRoute("home");
    	}    	
    }

}