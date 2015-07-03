<?php

use Stubs\ActiveQuery;
use Stubs\Model;

/**
 * @covers Mobileka\ScopeApplicator\Yii2\ActiveQuery
 */
class ActiveQueryTest extends TestCase
{
    /**
     * @test
     * @covers Mobileka\ScopeApplicator\Yii2\ActiveQuery::getInputManager
     */
    public function returns_input_manager_instance()
    {
        $aq = new ActiveQuery(new Model);
        assertInstanceOf('Mobileka\ScopeApplicator\Contracts\InputManagerInterface', $aq->getInputManager());
    }

    /**
     * @test
     * @covers Mobileka\ScopeApplicator\Yii2\Repository::getLogger
     */
    public function returns_logger_instance()
    {
        $aq = new ActiveQuery(new Model);
        assertInstanceOf('Mobileka\ScopeApplicator\Contracts\LoggerInterface', $aq->getLogger());
    }

    /**
     * @test
     * @covers Mobileka\ScopeApplicator\Yii2\ActiveQuery::applyScopes
     */
    public function applies_scopes()
    {
        $aq = new ActiveQuery(new Model);
        assertInstanceOf('Stubs\ActiveQuery', $aq->applyScopes($aq, ['scope']));
    }
}
