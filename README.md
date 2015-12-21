# Feedback
Simple feedback module for zf2 with bootstrap3. It is integrated with zfcUser
auth module. It contains captcha spam protection. User's feedback will send to your email.
### Example of interface
![Module interface](https://raw.githubusercontent.com/eugenzor/feedback/master/docs/images/interface.png)

# Install
* Add into you composer.json:
```json
require "eugenzor/feedback": "dev-master"
```
* run
```bash
php composer.phar update
```
* add modules Feedback and TwbBundle into you config/application.ini:
```php
<?php

return array(
    'modules' => array(
// .... some other modules
        'Feedback',   // <-------- Add
        'TwbBundle'   // <-------- this
    ),
// .... some other config
);

```
* copy module/Feedback/config/feedback.global.config.php.dict to the config/autoload/feedback.global.config.php
```bach
copy module/Feedback/config/feedback.global.config.php.dict config/autoload/feedback.global.config.php
```
* modify config/autoload/feedback.global.config.php and put your support email there
* run http[s]://{your_project_root}/feedback

# Configuration
It is also possible to configurate feedback form by changing default params. You can rewrite any of them in your config/feedback.global.config.php:
```php
return array(
    'feedback' => array(
        'title' => 'Feedback',
        'description' => 'If you want to contact us, please use this form',
        'display_flash_messages' => true, 
        'message_subject' => 'Feedback'
    ),
    //.....    
);

```
* title - feedback form title
* description - feedback form description
* display_flash_messages - if true, module will use local Flash Messenger to show succes or error message. If false dosn't show anything and hope that you use global Flash Messenger and show messages there.
* message_subject - Subject of email that will be send to the support address.