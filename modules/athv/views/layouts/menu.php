<?php

use mdm\admin\components\MenuHelper;

$menuCallback = function($menu){
  //Transforma de datos binarios a un string
  $data = ($menu['data'] != NULL) ? fgets($menu['data']) : FALSE;

  //Transforma de un string a un objeto/array
  if ($data)
    $data = eval($data);

  $opt = [
    'label' => $menu['name'],
    'url' => [$menu['route']],
    'items' => $menu['children']
  ];

  if ($data){
    if (isset($data['linkOptions'])){
      $opt['linkOptions'] = $data['linkOptions'];
      unset($data['linkOptions']);
    }

    $opt['options'] = $data;
  }

  return $opt;
};
 $this->beginBlock('blockMenus');
$opcMenu =(MenuHelper::getAssignedMenu(Yii::$app->user->id, 34, $menuCallback, TRUE));?>


<?php foreach ($opcMenu as $opc): ?>
                <li class="has_sub">
                    <a href="<?= $opc['url'][0] != NULL ? Yii::$app->urlManager->createUrl($opc['url'][0]) : '#' ?>">
                      <i class='fa fa-link'></i><span><?= $opc['label'] ?></span>
                      <?php if (!empty($opc['items'])): ?>
                        <ul style="display: none">
                          <?php foreach ($opc['items'] as $subopc): ?>
                            <li>
                              <a class="mostrar" href="<?= Yii::$app->urlManager->createUrl($subopc['url'][0])?>">
                                  <?= $subopc['label'] ?>
                              </a>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif; ?>
                    </a>
                </li>
              <?php endforeach; ?>
<?php $this->endBlock(); ?>
<?php $this->beginContent('@app/views/layouts/main_athv.php'); ?>

<?= $content ?>
<?php $this->endContent(); ?>
