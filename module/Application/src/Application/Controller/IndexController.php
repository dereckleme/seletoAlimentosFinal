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
use Application\Form\Contato;

class IndexController extends AbstractActionController
{
    public function indexAction() // home
    {
        return new ViewModel();
    }
    
    public function contatoAction() // contato
    {    		
    	$form = new Contato;
    	$request = $this->getRequest();
    	if($request->isPost())
    	{
    		$form->setData($request->getPost());
    	
    		if($form->isValid())
    		{    			
    			$dados = $request->getPost()->toArray();    		
    			
    			switch ($dados['destinatario']){    				
    				case 1: $to = "jorge.mota@seletoalimentos.com.br";
    				break;
    				case 2: $to = "lana.medeiros@seletoalimentos.com.br ";
    				break;
    				case 3: $to = "sac@seletoalimentos.com.br"; //$to = "sac.seletoalimentos@grupomex.com.br";
    				break;
    				case 4: $to = "sonia.binda@seletoalimentos.com.br";
    				break;
    				case 5: $to = "wilma.compri@seletoalimentos.com.br";
    				break;
    				#case 6: $to = "tarsila@spicycomm.com.br";
    				#break;
    				default: die('Campo Vazio');
    				break;
    			}
    			
    			$view = new ViewModel(array(
    				'fullname' => $dados['nome'],
    				'fullemail' => $dados['email'],
    				'fullphone' => $dados['phone'],
    				'fullsms' => $dados['mensagem'],
    			));
    			$view->setTerminal(true);
    			$view->setTemplate('Application/view/emails/contato');
    			$this->mailerZF2()->send(array(
    					'to' => '',
    					'cc' => $dados['email'],
    					'bcc' => 'seletoalimentos@seletoalimentos.com.br,'.$to.' ',
    					'subject' => 'Contato via [http://www.seletoalimentos.com.br]'
    			), $view);
    			
    			return $this->redirect()->toRoute('seletoContato');
    		}
    	}
    	
    	return new ViewModel(array('form' => $form));
    }
    
    public function enviarContatoAction()
    {
    	$form = new Contato;
    	
    	$request = $this->getRequest();
    	if($request->isPost())
    	{
    		$form->setData($request->getPost());
    		
    		if($form->isValid())
    		{
    			return $this->redirect()->toRoute('seletoContato');
    		}
    		else
    		{
    			$view = new ViewModel(array('mensagens'=>$form->getMessages()));
    			//$view->setTemplate('application/index/contato.phtml');
    			return $view;	
    		}
    	}
    	
    }
    
    public function domAction() // seleto dom
    {    	
    	return new ViewModel();
    }
    
    public function empresaAction() // empresa
    {    	
    	return new ViewModel();
    }
    
    public function politicaAction() // politica de privacidade
    {
    	return new ViewModel();
    }   
    
}
