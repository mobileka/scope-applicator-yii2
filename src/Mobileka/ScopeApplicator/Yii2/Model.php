<?php namespace Mobileka\ScopeApplicator\Yii2;

use Yii;
use yii\db\ActiveRecord;

abstract class Model extends ActiveRecord
{
    /**
     * @param array $scopes
     * @return ActiveQuery the newly created [[ActiveQuery]] instance.
     */
    public static function applyScopes($scopes = [])
    {
        $query = static::find();

        return $query->applyScopes($query, $scopes);
    }

    /**
     * @return ActiveQuery the newly created [[ActiveQuery]] instance.
     * @throws \yii\base\InvalidConfigException
     * @codeCoverageIgnore
     */
    public static function find()
    {
        return Yii::createObject(ActiveQuery::className(), [get_called_class()]);
    }
}