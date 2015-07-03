<?php

use Stubs\Model;

/**
 * @covers Mobileka\ScopeApplicator\Yii2\Model
 */
class ModelTest extends TestCase
{
    /**
     * @test
     * @covers Mobileka\ScopeApplicator\Yii2\Model::applyScopes
     */
    public function applies_scopes()
    {
        assertInstanceOf('Mobileka\ScopeApplicator\Yii2\ActiveQuery', Model::applyScopes(['scope']));
    }
}
