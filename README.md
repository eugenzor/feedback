# feedback
Simple feedback module for zf2 with bootstrap3. It is integrated with zfcUser
auth module.
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
* modify config/autoload/feedback.global.config.php and put your support email into the 
* run http[s]://{your_project_root}/feedback