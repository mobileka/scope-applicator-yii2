<?php

/**
 * @covers Mobileka\ScopeApplicator\Yii2\InputManager
 */
class InputManagerTest extends TestCase
{
    /**
     * @test
     * @covers Mobileka\ScopeApplicator\Yii2\InputManager::__construct
     */
    public function is_instantiable()
    {
        $im = new Mobileka\ScopeApplicator\Yii2\InputManager;
        assertTrue(method_exists($im, 'get'), 'Yii2InputManager has no "get" method');
    }

    /**
     * @test
     * @covers Mobileka\ScopeApplicator\Yii2\InputManager::get
     */
    public function gets_value_from_user_input()
    {
        $im = new Mobileka\ScopeApplicator\Yii2\InputManager;
        assertNull($im->get('param'));
        assertSame('no such param', $im->get('param', 'no such param'));

        // add something to request parameters
        $im->setQueryParams(['param' => 'hello']);

        assertEquals('hello', $im->get('param'));
    }
}
