<?php namespace Mobileka\ScopeApplicator\Yii2;

use Mobileka\ScopeApplicator\Contracts\LoggerInterface;
use Yii;

class Logger implements LoggerInterface
{
    /**
     * @param string $message
     * @codeCoverageIgnore
     */
    public function log($message)
    {
        Yii::error($message);
    }
}