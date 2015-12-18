<?php

return array(
    'elements' => array(
        array(
            'spec' => array(
                'name' => 'name',
                'type' => 'Text',
                'options' => array(
                    'label' => 'Your name'
                ),
            )
        ),
        
        array(
            'spec' => array(
                'name' => 'email',
                'type' => 'Email',
                'options' => array(
                    'label' => 'Your email'
                )
            )
        ),
        
        array(
            'spec' => array(
                'name' => 'message',
                'type' => 'Textarea',
                'options' => array(
                    'label' => 'Mesage'
                )
            )
        ),
        
        array(
            'spec' => array(
                'type' => 'Zend\Form\Element\Csrf',
                'name' => 'security',
            ),
        ),
        
        array(
            'spec' => array(
                'type' => 'Captcha',
                'name' => 'captcha',
                'options' => array(
                    'label' => 'Please verify you are human',
                    'captcha' => array(
                        'class' => 'Figlet',
                        'wordLen'    => 4,
//                        'use_numbers' => true,
                    ),
                ),
            ),
        ),
        
        array(
            'spec' => array(
                'name' => 'send',
                'type'  => 'Submit',
                'attributes' => array(
                    'value' => 'Submit',
                ),
            ),
        ),
    ),
    'input_filter' => array(
        array(
            'name' => 'name',
            'required' => true
        ),
        
        array(
            'name' => 'message',
            'required' => true
        )
    )
);