# feedback
Simple feedback module for zf2 with bootstrap3. It is integrated with zfcUser
auth module.

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
        'Feedback',
        'TwbBundle'
    ),
// .... some other config
);

```

# Configuring
