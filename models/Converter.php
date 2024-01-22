<?php

namespace gm\humhub\modules\converter\models;

use yii\base\Model;

/**
 * Converter model
 */
class Converter extends Model
{
    public $sqlInput;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sqlInput'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sqlInput' => 'Enter SQL Query',
        ];
    }
}
