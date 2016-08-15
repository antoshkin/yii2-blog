<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['username', 'password'], 'required', 'on' => 'first_admin'],


            ['username', 'trim', 'except' => 'first_admin'],
            ['username', 'required', 'except' => 'first_admin'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.', 'except' => 'first_admin'],
            ['username', 'string', 'min' => 2, 'max' => 255, 'except' => 'first_admin'],

            ['email', 'trim', 'except' => 'first_admin'],
            ['email', 'required','except' => 'first_admin'],
            ['email', 'email','except' => 'first_admin'],
            ['email', 'string', 'max' => 255,'except' => 'first_admin'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.','except' => 'first_admin'],

            ['password', 'required','except' => 'first_admin'],
            ['password', 'string', 'min' => 6,'except' => 'first_admin'],



        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ( $user->save(false) && 'default' == $this->getScenario()  ) {

            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('user');
            $auth->assign( $authorRole, $user->getId() );

        }
        
        return $user ? $user : null;
    }


}
