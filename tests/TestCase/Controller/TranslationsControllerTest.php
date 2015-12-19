<?php
namespace App\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

class TranlationsControllerTest extends IntegrationTestCase
{

    public function testImport()
    {
        $this->get('/wnk_translation/translations/import');
        $this->assertResponseSuccess();
    }

    public function testPrepare()
    {
        $this->get('/wnk_translation/translations/prepare');
        $this->assertResponseSuccess();
    }

    public function testExport()
    {
        $this->get('/wnk_translation/translations/export');
        $this->assertResponseSuccess();
    }

}
