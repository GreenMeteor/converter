<?php

namespace gm\humhub\modules\converter\controllers;

use yii\web\Controller;
use yii\web\Response;
use gm\humhub\modules\converter\models\Converter;

class SqlConverterController extends Controller
{
    public function actionIndex()
    {
        $model = new Converter();

        if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post()) && $model->validate()) {
            // Form submission is valid, proceed with conversion
            $sqlInput = $model->sqlInput;

            // Convert SQL to HumHub database SQL
            $convertedSql = $this->convertSqlToHumHub($sqlInput);

            // Set the title before rendering the view
            $this->view->title = 'SQL to HumHub Converter';

            // Render the view with the model and the converted SQL
            return $this->render('index', ['model' => $model, 'convertedSql' => $convertedSql]);
        }

        // If the form submission is not valid, or it's not a POST request, render the index view
        return $this->render('index', ['model' => $model]);
    }

    private function convertSqlToHumHub($sql)
    {
        // Example: Replace table and column names
        $replacementMap = [
            'users' => 'user',
            'posts' => 'posts',
            'comments' => 'comments',
            'id' => 'id',
            'name' => 'username',
            'email' => 'email',
            'created_at' => 'created_at',
            'content' => 'content',
            'user_id' => 'user_id',
        ];

        // Regular expression pattern to match table and column names
        $pattern = '/\b(' . implode('|', array_keys($replacementMap)) . ')\b/i';

        // Replace names using preg_replace
        $convertedSql = preg_replace_callback($pattern, function ($matches) use ($replacementMap) {
            return $replacementMap[strtolower($matches[0])];
        }, $sql);

        return $convertedSql;
    }
}
