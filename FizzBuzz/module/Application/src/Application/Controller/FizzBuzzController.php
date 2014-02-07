<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FizzBuzzController extends AbstractActionController
{
    public function indexAction()
    {
        $mixCondicao = '';
        
        if ($this->getRequest()->isPost()) {
            $arrDadosPost = $this->getRequest()->getPost()->toArray();
            $mixCondicao = $this->getServiceLocator()->get('Application\Service\FizzBuzz')
                ->verificarFizzBuzz($arrDadosPost['numero']);
        }

        return new ViewModel(
            array(
                'mixResultado' => $mixCondicao
            )
        );
    }
}
