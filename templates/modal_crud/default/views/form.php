<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$classNamespace = StringHelper::dirname(ltrim($generator->modelClass, '\\'));
$hasForeignKeys = (!empty($generator->getTableSchema()->foreignKeys));
$foreignClassAdded = [];

$model = new $generator->modelClass();

$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";

if ($hasForeignKeys) {
    foreach ($generator->getTableSchema()->foreignKeys as $foreign) {
        $referencedClass = Inflector::camelize($foreign[0]);
        
        if (!in_array($referencedClass, $foreignClassAdded)) {
            $foreignClassAdded[] = $referencedClass;
            echo "use {$classNamespace}\\{$referencedClass};\n";
        }
    }
}

if ($hasForeignKeys) {
    echo "use yii\helpers\ArrayHelper;\n";
}
?>
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$currentAction = ($model->isNewRecord) ? <?= $generator->generateString('Create') ?> : <?= $generator->generateString('Update') ?>;

$this->title = $currentAction . ' ' . <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];

if (!$model->isNewRecord) {
    $this->params['breadcrumbs'][] = ['label' => $model-><?= $generator->getNameAttribute() ?>, 'url' => ['view', <?= $urlParams ?>]];
}

$this->params['breadcrumbs'][] = $currentAction;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-save-form">

<?php if (!$generator->useModals): ?>
    <h1><?= "<?= " ?>Html::encode($this->title) ?></h1>

<?php endif; ?>
    <?= "<?php " ?>$form = ActiveForm::begin(); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "    <div class=\"row\">\n";
        echo "        <div class=\"col-md-12\">\n";
        echo "            <?= " . $generator->generateActiveField($attribute) . " ?>\n";
        echo "        </div>\n";
        echo "    </div>\n\n";
    }
} ?>

<?php if (!$generator->useModals): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Save') ?>, ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

<?php endif; ?>
    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
