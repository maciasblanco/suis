<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
$modelIdName = Inflector::camel2id(StringHelper::basename($generator->modelClass));
$modelClassPluralWords = Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)));
$classNamespace = StringHelper::dirname(ltrim($generator->modelClass, '\\'));
$hasForeignKeys = (!empty($generator->getTableSchema()->foreignKeys));
$foreignClassAdded = [];

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
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget">
    <div class="widget-header transparent">
        <h2><strong><?= "<?= " ?>Html::encode($this->title) ?></strong></h2>
        <div class="additional-btn">         
            <a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
            <a href="#" class="widget-toggle hidden"><i class="icon-down-open-2"></i></a>
        </div>
    </div>

    <div class="widget-content padding">
<?php if ($generator->enablePjax){
    echo "        <?php Pjax::begin(['id' => '{$modelIdName}-grid-pjax']); ?>\n";
} ?>
<?php if(!empty($generator->searchModelClass)): ?>
<?= "        <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>

        <p>
            <?= "<?= " ?>Html::a(<?= $generator->generateString('Crear ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, ['save '], [
<?php if ($generator->useModals): ?>
                'class' => 'btn btn-success link-for-modal',
                'data-title' => <?= $generator->generateString('Crear ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) . "\n" ?>,
<?php else: ?>
                'class' => 'btn btn-success',
<?php endif; ?>
                'data-pjax' => 0,
            ]) ?>
        </p>

<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "    <?= " ?>GridView::widget([
            'dataProvider' => $dataProvider,
        <?= !empty($generator->searchModelClass) ? "    'filterModel' => \$searchModel,\n            'columns' => [\n" : "    'columns' => [\n"; ?>
                ['class' => 'yii\grid\SerialColumn'],

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
            echo "            '" . $name . "',\n";
        } else {
            echo "                //'" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if (++$count < 6) {
            if ($ref = $generator->getForeignKey($column->name)) {
                $class = Inflector::camelize($ref['table']);
                $col = $ref['attribute'];
                $relName = lcfirst($class);
                echo "            [\n";
                echo "                'attribute' => '{$column->name}',\n";
                echo "                'filter' => ArrayHelper::map({$class}::find()->all(), '{$col}', '{$col}'),\n";
                echo "                'value' => function (\$model) {\n";
                echo "                    return \$model->{$relName};\n";
                echo "                },\n";
                echo "            ],\n";
            } else {
                echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            }
        } else {
            echo "                //'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
}
?>

                [
                    'class' => 'yii\grid\ActionColumn',
                    'urlCreator' => function($action, $model, $key, $index, $actionColumn) {
                        switch ($action) {
                            case 'view':
                                return ["<?= $modelIdName ?>/$action", <?= $urlParams ?>];
                                break;
                            case 'update':
                                return ["<?= $modelIdName ?>/save", <?= $urlParams ?>];
                                break;
                            case 'delete':
                                return ["<?= $modelIdName ?>/$action", <?= $urlParams ?>];
                                break;
                        }
                    },
<?php if ($generator->useModals): ?>
                    'buttons' => [
                        'view' => function ($url, $model, $key)  {
                            $icon = Html::tag('span', '', [
                                'class' => 'glyphicon glyphicon-eye-open',
                            ]);
                            return Html::a($icon, $url, [
                                'title' => 'Ver',
                                'aria-label' => 'Ver',
                                'data-pjax' => 0,
                                'data-title' => 'Ver ' . $model-><?= $generator->getNameAttribute() ?>,
                                'data-hide-save' => true,
                                'class' => 'link-for-modal',
                            ]);
                        },
                        'update' => function ($url, $model, $key)  {
                            $icon = Html::tag('span', '', [
                                'class' => 'glyphicon glyphicon-pencil',
                            ]);
                            return Html::a($icon, $url, [
                                'title' => 'Actualizar',
                                'aria-label' => 'Actualizar',
                                'data-pjax' => 0,
                                'data-title' => 'Actualizar ' . $model-><?= $generator->getNameAttribute() ?>,
                                'class' => 'link-for-modal',
                            ]);
                        },
                    ],
<?php endif; ?>
                ],
            ],
        ]); ?>
<?php else: ?>
    <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
    ]) ?>
<?php endif; ?>
<?= $generator->enablePjax ? "        <?php Pjax::end(); ?>\n" : '' ?>
        </div>
    </div>
</div>

<?php if ($generator->useModals): ?>
<div class="modal fade" id="<?= $modelIdName ?>-modal" role="dialog" aria-labelledby="<?= $modelIdName ?>-modal-title">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="<?= $modelIdName ?>-modal-title"></h4>
            </div>
            <div class="modal-body" id="<?= $modelIdName ?>-modal-body"></div>
            <div class="modal-footer" id="<?= $modelIdName ?>-modal-footer">
                <button id="<?= $modelIdName ?>-modal-close-btn" type="button" class="btn btn-default" data-dismiss="modal"><?= '<?= ' . $generator->generateString('Cerrar') ?> ?></button>
                <button id="<?= $modelIdName ?>-modal-save-btn" type="button" class="btn btn-primary"><?= '<?= ' . $generator->generateString('Guardar') ?> ?></button>
            </div>
        </div>
    </div>
</div>

<?= "<?php\n" ?>
$this->registerJs(<<<JAVASCRIPT
    //When clicking a links loads the view in a modal
    $(document).on("click", ".link-for-modal", function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var method = $(this).data('method') ? $(this).data('method') : 'get';
        var title = $(this).data('title') ? $(this).data('title') : '';
        var hideSave = typeof $(this).data('hide-save') != "undefined" ? true : false;
        
        $.ajax({
            url: url,
            type: method,
            beforeSend: function(jqXHR, settings) {
                $("#<?= $modelIdName ?>-modal-title").html(title);
                $("#<?= $modelIdName ?>-modal-body").html('<center><div class="loader"></div></center>');

                if (hideSave) {
                    $("#<?= $modelIdName ?>-modal-save-btn").hide();
                } else {
                    $("#<?= $modelIdName ?>-modal-save-btn").show();
                }

                $("#<?= $modelIdName ?>-modal").modal("show");
            },
            success: function(data, textStatus, jqXHR) {
                $("#<?= $modelIdName ?>-modal-body").html(data);
                $("#<?= $modelIdName ?>-modal-body").find('select').each(function() {
                    loadSelect2(this);
                });
            }, 
        });
        return false;
    });

    //The modal save button, triggers the modal form submit
    $(document).on("click", "#<?= $modelIdName ?>-modal-save-btn", function() {
        $("#<?= $modelIdName ?>-modal form").submit();
    });

    //Modals forms are sended by ajax
    $(document).on("submit", "#<?= $modelIdName ?>-modal form", function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var data = form.serialize();

        $.ajax({
            url: url,
            data: data,
            type: 'post',
            beforeSend: function(jqXHR, settings) {
                $("#<?= $modelIdName ?>-modal-body").html('<center><div class="loader"></div></center>');
                $("#<?= $modelIdName ?>-modal").modal("show");
            },
            success: function(data, textStatus, jqXHR) {
                if (data != "close-modal") {
                    $("#<?= $modelIdName ?>-modal-body").html(data);
                    $("#<?= $modelIdName ?>-modal-body").find('select').each(function() {
                        loadSelect2(this);
                    });
                } else {
                    $("#<?= $modelIdName ?>-modal").modal("hide");
                    $.pjax({container: '#<?= $modelIdName ?>-grid-pjax'})
                }
            }
        });

        return false;
    });
JAVASCRIPT
);
<?php endif; ?>

$this->registerJs(<<<JAVASCRIPT
    //Select2 is activated when the page loads
    $("select").each(function() {
        loadSelect2(this);
    });

    //After a pjax load, Select2 is reactivated
    $(document).on('pjax:complete', function() {
        $("select").each(function() {
            loadSelect2(this);
        });
    });
JAVASCRIPT
);