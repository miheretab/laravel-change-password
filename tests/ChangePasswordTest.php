<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChangePasswordTest extends TestCase
{

    public function testRoute()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
             ->visit('/password/change')
             ->see('Change password');
    }

    public function testAuthentication()
    {
        $this->visit('/password/change')
             ->seePageIs(route('login'));
    }

    public function testifActionExists()
    {
        $user = factory(App\User::class)->create();
        
        $response = $this->actingAs($user)
                         ->action('GET', 'PasswordController@change');
        $this->assertEquals(200, $response->status());
    }

    public function testViewValues()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
             ->visit('/password/change')
             ->assertViewHas('mode', 'edit')
             ->assertViewHas('formAction', '/password/change');
    }

    public function testifOldPasswordEmptyFails()
    {
        $user = factory(App\User::class)->create();
        
        $this->actingAs($user)
                         ->visit('/password/change')
                         ->type('', 'old_password')
                         ->press('Save')
                         ->see('The old password field is required');
    }

    public function testifNewPasswordEmptyFails()
    {
        $user = factory(App\User::class)->create();
        
        $this->actingAs($user)
                         ->visit('/password/change')
                         ->type('', 'password')
                         ->press('Save')
                         ->see('The password field is required');
    }

    public function testifPasswordMatchesFails()
    {
        $user = factory(App\User::class)->create();
        
        $this->actingAs($user)
                         ->visit('/password/change')
                         ->type('12345678', 'password')
                         ->type('', 'password_confirmation')
                         ->press('Save')
                         ->see('The password confirmation does not match');
    }

    public function testifPasswordLengthFails()
    {
        $user = factory(App\User::class)->create();
        
        $this->actingAs($user)
                         ->visit('/password/change')
                         ->type('12345', 'password')
                         ->press('Save')
                         ->see('The password must be at least 8 characters');
    }

    public function testifOldPasswordFails()
    {
        $user = factory(App\User::class)->create(['password' => bcrypt('test')]);

        $this->actingAs($user)
                         ->visit('/password/change')
                         ->type('test1', 'old_password')
                         ->press('Save')
                         ->see('The old password is invalid');
    }

    public function testifPasswordChangePasses()
    {
        $user = factory(App\User::class)->create(['password' => bcrypt('test')]);
        
        $this->actingAs($user)
                         ->visit('/password/change')
                         ->type('test', 'old_password')
                         ->type('12345678', 'password')
                         ->type('12345678', 'password_confirmation')
                         ->press('Save')
                         ->see('The password is successfully changed');
    }

}
