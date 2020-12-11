<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\rest\ ActiveController;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\web\BadRequestHttpException;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';
    public $enableCsrfValidation = false;
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'login',
                'register',
            ],
        ];

        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),

            'cors' => [
                // restrict access to
                'Origin' => ['*'],
                // Allow only POST and PUT methods
                'Access-Control-Request-Method' => ['POST', 'GET'],
                // Allow only headers 'X-Wsse'
                'Access-Control-Request-Headers' => ['X-Wsse'],
                // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
                'Access-Control-Allow-Credentials' => true,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 3600,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],
        ];

        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];
    
        return $behaviors;
    }
    
    public function actionLogin()
    {
        $request = Yii::$app->request;
        $name = $request->getBodyParam('username');
        $password = $request->getBodyParam('password');
        $model = User::findOne(['username' => $name]);
        if ($model->username == $name && $model->password == $password) {
            $jwt = Yii::$app->jwt;
            $signer = $jwt->getSigner('HS256');
            $key = $jwt->getKey();
            $time = time();
            $token = $jwt->getBuilder()
            ->issuedBy('http://example.com')// Configures the issuer (iss claim)
            ->permittedFor('http://example.org')// Configures the audience (aud claim)
            ->identifiedBy('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
            ->issuedAt($time)// Configures the time that the token was issue (iat claim)
            ->expiresAt($time + 3600)// Configures the expiration time of the token (exp claim)
            ->withClaim('uid', 100)// Configures a new claim, called "uid"
            ->getToken($signer, $key); // Retrieves the generated token
            $model['access_token'] =(string) $token;
            $model->save();
            return $this->asJson($model);
        }
        throw new BadRequestHttpException("用户名或密码错误");
    }
    /**
     * @return \yii\web\Response
     */
    public function actionData()
    {
        return $this->asJson([
            'success' => true,
        ]);
    }

    public function actionRegister()
    {
        $request = Yii::$app->request;
        $name = $request->getBodyParam('username');
        $password = $request->getBodyParam('password');
        $model = User::findOne(['username' => $name]);
        if ($model == null && $name !== " "&& $password !== " ") {
            $data = [
                'username' => $name,
                'password' => $password
            ];
            $collection = Yii::$app->mongodb->getCollection('user');
            $collection->insert($data);
            return "注册成功";
        }
        throw new BadRequestHttpException("用户名已存在并且用户名和密码不可以为空");
    }

    public function actionQueryuser()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = User::findOne(['_id' => $id]);
        return $model;
    }

    public function actionDeleteuser()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = User::findOne(['_id' => $id]);
        if ($model == null) {
            throw new BadRequestHttpException("用户不存在");
        }
        $model->delete();
    }

    public function actionUpdatepassword()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = User::findOne(['_id' => $id]);
        $userPassword= $model->password;
        $oldPassword = $request->getBodyParam('oldPassword');
        $newPassword = $request->getBodyParam('newPassword');
        if ($userPassword !== $oldPassword || $newPassword == " ") {
            throw new BadRequestHttpException("用户密码修改失败");
        }
        $model->password = $newPassword;
        var_dump($model->password);
        $model->save();
    }
}
