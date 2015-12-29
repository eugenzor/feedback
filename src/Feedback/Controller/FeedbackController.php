<?php

namespace Feedback\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Factory as FormFactory;
use PHPMailer\PHPMailer\PHPMailer;

class FeedbackController extends AbstractActionController
{


    
    protected function getFlashMessengerNamespaces()
    {
        $config = $this->getServiceLocator()->get('config');
        if ($config['feedback']['display_flash_messages']){
            $error = 'feedback_error';
            $success = 'feedback_success';
        }else{
            $error = 'error';
            $success = 'success';
        }
        return compact('success', 'error');
    }

    
    public function indexAction()
    {
        $services = $this->getServiceLocator();
        
        $config = $services->get('config');
        $translator = $services->get('translator');
        
        $namespaces = $this->getFlashMessengerNamespaces();
        
        $user = $this->getAuthInfo();
        
        $formFactory = new FormFactory();
        $formConfig = $config['feedback']['message_form'];
        if ($user){
            unset($formConfig['elements']['captcha']);
        }
        $form = $formFactory->createForm($formConfig);
        
        if ($this->getRequest()->isPost()){
            $form->setData($this->params()->fromPost());
            if ($form->isValid()){
                $data = $form->getData();
                
                $mail = new PHPMailer;
                $mail->setFrom($data['email'], $data['name']);
                $mail->addAddress($config['feedback']['support_address']);
                $subject = $translator->translate($config['feedback']['message_subject']);
                $mail->Subject = str_replace('%name%', $data['name'], $subject);
                $mail->Body = $data['message'];
                $mail->send();
                
               
                $this->flashMessenger()->addSuccessMessage(
                    $translator->translate('Message was successfully sent. Thanks for feedback')
                );
                return $this->redirect()->refresh();
            }else{
                $this->flashMessenger()->addMessage(
                        $translator->translate('Form has errors. Check it'),
                        $namespaces['error']
                );

            }
        }else{
            if ($user){
                $form->get('name')->setValue($user->getDisplayName());
                $form->get('email')->setValue($user->getEmail());           
            }
        }
        
        return array(
            'form'=>$form, 
            'title' => $config['feedback']['title'],
            'description' => $config['feedback']['description'],
            'display_flash_messages' => $config['feedback']['display_flash_messages']
        );
    }


    protected function getAuthInfo()
    {
        try{
            //if we are using zfcuser
            $auth = $this->zfcUserAuthentication();
            if ($auth){
                $user = $auth->getIdentity();
                if ($user){
                    return $user;
                    $form->get('name')->setValue($user->getDisplayName());
                    $form->get('email')->setValue($user->getEmail());           
                }
            }

        } catch (\Exception $ex) {
        }
        return false;
    }
    
}

