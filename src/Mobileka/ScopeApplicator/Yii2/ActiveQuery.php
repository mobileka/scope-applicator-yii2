<?php namespace Mobileka\ScopeApplicator\Yii2;

use Mobileka\ScopeApplicator\ScopeApplicator;

class ActiveQuery extends \yii\db\ActiveQuery
{
    use ScopeApplicator;

    /**
     * @return \Mobileka\ScopeApplicator\Contracts\InputManagerInterface
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