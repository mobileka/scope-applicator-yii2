<?php

/**
 * @covers Mobileka\ScopeApplicator\Yii2\Repository
 */
class RepositoryTest extends TestCase
{
    /**
     * @test
     * @covers Mobileka\ScopeApplicator\Yii2\Repository::getInputManager
     */
    public function returns_input_manager_instance()
    {
        $repository = new Stubs\Repository;
        assertInstanceOf('Mobileka\ScopeApplicator\Contracts\InputManagerInterface', $repository->getInputManager());
    }

    /**
     * @test
     * @covers Mobileka\ScopeApplicator\Yii2\Repository::getLogger
     */
    public function returns_logger_instance()
    {
        $repository = new Stubs\Repository;
        assertInstanceOf('Mobileka\ScopeApplicator\Contracts\LoggerInterface', $repository->getLogger());
    }
}
