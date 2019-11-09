<?php

namespace tests\unit\models;

use app\models\UserOldModel;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = UserOldModel::findIdentity(100));
        expect($user->username)->equals('admin');

        expect_not(UserOldModel::findIdentity(999));
    }

    public function testFindUserByAccessToken()
    {
        expect_that($user = UserOldModel::findIdentityByAccessToken('100-token'));
        expect($user->username)->equals('admin');

        expect_not(UserOldModel::findIdentityByAccessToken('non-existing'));
    }

    public function testFindUserByUsername()
    {
        expect_that($user = UserOldModel::findByUsername('admin'));
        expect_not(UserOldModel::findByUsername('not-admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = UserOldModel::findByUsername('admin');
        expect_that($user->validateAuthKey('test100key'));
        expect_not($user->validateAuthKey('test102key'));

        expect_that($user->validatePassword('admin'));
        expect_not($user->validatePassword('123456'));        
    }

}
