 
#Translation Plugin for CakePHP 3

It provides translation services for pot files:

- import strings to be translated from pot files
- translations
  - manual translations
  - translations by google translation services
  - community translations - self service (planned)
- export translated strings to pot files
 


##Installation

composer require ava007/wnk_translation

###Config/bootstrap.php

Plugin::load('WnkTranslation', ['routes' => true, 'autoload' => true, 'bootstrap' => false]);

##URL

After installation the plugins is called used the following url:

http://....domainname/wnk_translation/translations/index


## References

visit http://41share.com/wnk_translation/translation/index to see this plugin in action
