<?php

use yii\helpers\ArrayHelper;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $commentModel \yii2mod\comments\models\CommentModel */
/* @var $maxLevel null|integer comments max level */
/* @var $encryptedEntity string */
/* @var $pjaxContainerId string */
/* @var $formId string comment form id */
/* @var $commentDataProvider \yii\data\ArrayDataProvider */
/* @var $listViewConfig array */
/* @var $commentWrapperId string */
?>




<div class="nk-chat" id="<?php echo $commentWrapperId; ?>">
    
    <div class="nk-chat-body ">
    
    <div>
    <?php Pjax::begin(['enablePushState' => false, 'timeout' => 20000, 'id' => $pjaxContainerId]); ?>
        <div class="nk-chat-head">
            <ul class="nk-chat-head-info">
                <li class="nk-chat-body-close">
                    <a href="#" class="btn btn-icon btn-trigger nk-chat-hide ms-n1">
                        <em class="icon ni ni-arrow-left"></em></a></li>
                <li class="nk-chat-head-user">
                    <div class="user-card">
                        <div class="user-info">
                            <div class="lead-text">Acreedor</div>
                            <div class="sub-text"><span class="d-none d-sm-inline me-1">
                                        <?php echo Yii::t('yii2mod.comments', 'Comments ({0})', $commentModel->getCommentsCount()); ?>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="nk-chat-head-search">
                <div class="form-group">
                    <div class="form-control-wrap">
                        <div class="form-icon form-icon-left"><em class="icon ni ni-search"></em></div>
                        <input type="text" class="form-control form-round" id="chat-search"
                               placeholder="Search in Conversation"></div>
                </div>
            </div>
        </div>

        <div class="nk-chat-panel data-simplebar">
            <?php echo ListView::widget(ArrayHelper::merge(
                [
                    'dataProvider' => $commentDataProvider,
                    'layout' => "{items}\n{pager}",
                    'itemView' => '_list',
                    'viewParams' => [
                        'maxLevel' => $maxLevel,
                    ],
                    'options' => [
                        //  'tag' => 'div',
                        //  'class' => 'simplebar-content',
                    ],
                    'itemOptions' => [
                        'tag' => false,
                    ],
                ],
                $listViewConfig
            )); ?>

        </div>

        <?php if (!Yii::$app->user->isGuest) : ?>

            <?php echo $this->render('_form', [
                'commentModel' => $commentModel,
                'formId' => $formId,
                'encryptedEntity' => $encryptedEntity,
            ]); ?>

        <?php endif; ?>
        <?php Pjax::end(); ?>
        
    </div>
    
    
</div>

