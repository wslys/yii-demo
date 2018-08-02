<?php
namespace backend\controllers;

use common\models\ResourceList;
use frontend\models\SignupForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'signup'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $lists = ResourceList::find()->asArray()->orderBy('level, parent_id')->all();
        $list_menu = [];
        foreach ($lists as $item) {
            $id = $item['id'];
            $parent_id = $item['parent_id'];

            if (!$parent_id) {
                $list_menu[$id] = $item;
            }else {
                if (!isset($list_menu[$parent_id]['items']))
                    $list_menu[$parent_id]['items'] = [];

                $list_menu[$parent_id]['items'][$id] = $item;
            }
        }

        $menus = [['label' => '菜单按钮', 'options' => ['class' => 'header']],];
        foreach ($list_menu as $item) {
            $menu = [
                'label' => $item['label'],
                'icon' => $item['icon'],
                'url' => $item['url'],
                'items' => []
            ];
            if (count($item['items']) > 0) {
                foreach ($item['items'] as $_item) {
                    $menu['items'][] = [
                        'label' => $_item['label'],
                        'icon' => $_item['icon'],
                        'url' => [$_item['url']]
                    ];
                }
            }
            $menus[] = $menu;
        }

        return $this->render('index', [
            'list_menu' => $menus
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup () {
        $model = new SignupForm();

        // 如果是post提交且有对提交的数据校验成功（我们在SignupForm的signup方法进行了实现）
        // $model->load() 方法，实质是把post过来的数据赋值给model
        // $model->signup() 方法, 是我们要实现的具体的添加用户操作
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->redirect(['index']);
        }

        // 渲染添加新用户的表单
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
