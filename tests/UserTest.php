<?php

class UserTest extends TestCase {
    /**
     * Test user creation
     * 
     * @test
     */
    public function newUserTest()
    {
        $email = 'a@bc.d';
        $pwd = 'pass34dsifjsdiv';

        $this->notSeeInDatabase('users', ['email' => $email]);
        $this->post('auth/register', ['email' => $email, 'password' => $pwd])->seeStatusCode(200);
        $this->seeInDatabase('users', ['email' => $email]);
    }
}
