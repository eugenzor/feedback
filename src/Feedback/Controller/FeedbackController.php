<?php

namespace Feedback\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Factory as FormFactory;
use Zend\Mail;

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
        $config = $this->getServiceLocator()->get('config');
        $translator = $this->getServiceLocator()->get('translator');
        
        $namespaces = $this->getFlashMessengerNamespaces();
        
        $formFactory = new FormFactory();
        $form = $formFactory->createForm($config['feedback']['message_form']);
        
        if ($this->getRequest()->isPost()){
            $form->setData($this->params()->fromPost());
            if ($form->isValid()){
                $data = $form->getData();
                $mail = new Mail\Message();
                $mail->setBody($data['message']);
                $mail->setFrom($data['email'], $data['name']);
                $mail->addTo($config['feedback']['support_address']);
                $subject = $translator->translate($config['feedback']['message_subject']);
                $subject = str_replace('%name%', $data['name'], $subject);
                $mail->setSubject($subject);
                $transport = new Mail\Transport\Sendmail();
                $transport->send($mail);
                
                $this->flashMessenger()->addMessage(
                    $translator->translate('Message was successfully sent. Thanks for feedback'),
                    $namespaces['success']
                );
                $this->redirect()->toRoute('feedback');
            }else{
                $this->flashMessenger()->addMessage(
                        $translator->translate('Form has errors. Check it'),
                        $namespaces['error']
                );

            }
        }else{
            try{
                //if we are using zfcuser
                $auth = $this->zfcUserAuthentication();
                if ($auth){
                    $user = $auth->getIdentity();
                    if ($user){
                        $form->get('name')->setValue($user->getDisplayName());
                        $form->get('email')->setValue($user->getEmail());           
                    }
                }

            } catch (\Exception $ex) {
            }
        }
        
        return array(
            'form'=>$form, 
            'title' => $config['feedback']['title'],
            'description' => $config['feedback']['description'],
            'display_flash_messages' => $config['feedback']['display_flash_messages']
        );
    }


}

