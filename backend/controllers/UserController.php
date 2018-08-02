<?php

namespace backend\controllers;

use common\models\search\UserGroupUserSearch;
use common\models\UserGroup;
use Yii;
use common\models\User;
use common\models\search\UserSearch;
use backend\base\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /* ====== 用户组管理 ====== */
    /**
     * 用户组列表
     * @return string
     */
    public function actionUserGroup() {
        $searchModel = new UserGroup();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('user-group', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 创建用户组
     * @return string
     */
    public function actionUserGroupCreate() {
        $model = new UserGroup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['user-group-view', 'id' => $model->id]);
        }

        return $this->render('user-group-create', [
            'model' => $model,
        ]);
    }

    /**
     * 查看用户组信息
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionUserGroupView($id) {
        return $this->render('user-group-view', [
            'model' => $this->findGroupModel($id),
        ]);
    }

    /**
     * 更新用户组
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUserGroupUpdate($id)
    {
        $model = $this->findGroupModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['user-group-view', 'id' => $model->id]);
        }

        return $this->render('user-group-update', [
            'model' => $model,
        ]);
    }

    /**
     * 删除用户组
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionUserGroupDelete($id)
    {
        $this->findGroupModel($id)->delete();

        return $this->redirect(['user-group']);
    }


    /* ====== 用户用户组分配 ====== */
    public function actionUserGroupConf() {
        $searchModel = new UserGroupUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('user-group-conf', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @return UserGroup|null
     * @throws NotFoundHttpException
     */
    protected function findGroupModel($id)
    {
        if (($model = UserGroup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
