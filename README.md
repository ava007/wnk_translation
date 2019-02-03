 
# Translation Plugin for CakePHP 3.6

It provides translation services for pot files:

- import strings to be translated from pot files
- translations
  - manual translations
  - translations by google translation services
  - community translations - self service (planned)
- export translated strings to pot files
 


## Installation
``` shell
composer require ava007/wnk_translation
```

### Config/bootstrap.ph
```
Plugin::load('WnkTranslation', ['routes' => true, 'autoload' => true, 'bootstrap' => false]);

Configure::write('WnkTranslation', [
    'default_lang' => 'en',    // Language in which the application has been developed
    'trans_lang' => ['de','fr','it'],   // Languages in which the application should be translated to
    'tablePrefix' => '',     // optional prefix for database tables
]);
```
### src/Application.php
```
class Application //extends BaseApplication {

  public function bootstrap() {
    parent::bootstrap();
    $this->addPlugin('WnkTranslation');
  }
}
```
### Database

run one of the appropriate sql-ddl-script:
- postgresql:   ddl-postgresql.sql
- mysql:        ddl-mysql.sql

### URL

After installation the plugins is called used the following url:

http://....domainname/wnk-translation/translations/cockpit


## References



visit https://www.locavores.co/wnk-translation/translations/index to see this plugin in action

