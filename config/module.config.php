<?php
return array(
    'feedback' => array(
        'message_form' => include __DIR__ . '/message.form.config.php',
        'title' => 'Feedback',
        'description' => 'If you want to contact us, please use this form',
        'display_flash_messages' => true,
        'message_subject' => 'Feedback',
        'support_address' => 'your@email.com'
    ),    
    
    'router' => array(
        'routes' => array(
            'feedback' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/feedback',
                    'defaults' => array(
                        'controller' => 'Feedback\Feedback',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    
    'controllers' => array(
        'invokables' => array(
            'Feedback\Feedback' => 'Feedback\Controller\FeedbackController'
        )
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    
);