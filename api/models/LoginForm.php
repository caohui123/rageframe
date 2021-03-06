<?php
namespace api\models;

use Yii;
use common\models\member\Member;

/**
 * Login form
 */
class LoginForm extends \common\models\base\LoginForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username'   => '登录帐号',
            'password'   => '登录密码',
        ];
    }

    /**
     * 用户登陆
     * @return null|static
     */
    public function getUser()
    {
        if ($this->_user == false)
        {
            if (strpos($this->username, "@"))
            {
                $this->_user = Member::findOne(['email'=>$this->username]); //email 登录
            }
            else
            {
                $this->_user = Member::findByUsername($this->username);
            }
        }

        return $this->_user;
    }
}
