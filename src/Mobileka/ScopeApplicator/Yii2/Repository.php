<?php namespace Mobileka\ScopeApplicator\Yii2;

use Mobileka\ScopeApplicator\ScopeApplicator;

abstract class Repository
{
    use ScopeApplicator;

    /**
     * @return \Mobileka\ScopeApplicator\Yii2\InputManager
     */
    public function getInputManager()
    {
        return new InputManager;
    }

    /**
     * @return \Mobileka\ScopeApplicator\Contracts\LoggerInterface
     */
    public function getLogger()
    {
        return new Logger;
    }
}