<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class SaleUser extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return 'dashboard/users';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->type('email','ahmedsalem994.as@gmail.com')
            ->type('password','123456')
            ->click('#m_login_signin_submit')
            ->visit('/dashboard/users')
            ->assertSee('Index Users')
            ->pause(2000)
            ->waitFor('#items')
            ->pause(2000);

        $this->createSales($browser);
        $this->view($browser);
        $this->edit($browser);
        $this->delete($browser);
    }

    public function createSales($browser){
        $browser->pause(2000)
            ->visit('/dashboard/users/create')
            ->type('name','unittest')
            ->type('username','unittestman')
            ->type('email','unittest4.as@gmail.com')
            ->type('phone','012345678910')
            ->select('government_id','1')
            ->select('region_id','1')
            ->select('area_id','1')
            ->select('franchise_id','1')
            ->type('password','123456')
            ->click('.btn-primary')
            ->pause(2000)
            ->assertSee('Users');
    }

    public function delete($browser){
        $browser->pause(2000)
            ->click('#sale10 .dropdown > a')
            ->pause(2000)
            ->click('#sale10 .dropdown > ul .deleteAction')
            ->pause(2000)
            ->click('#delete-form-modal .modal-footer > #deleteConfirm')
            ->pause(2000);
    }

    public function view($browser){
        $browser->pause(2000)
            ->click('#sale5 .dropdown > a')
            ->pause(2000)
            ->click('#sale5 .dropdown > ul .viewsale')
            ->assertSee('Show Users')
            ->pause(2000)
            ->visit('/dashboard/users');

    }

    public function edit($browser){
        $browser->driver->executeScript('window.scrollTo(0, 500);');
        $browser->maximize()->pause(2000);
        $browser->click('#sale5 .dropdown > a')
            ->pause(2000)
            ->click('#sale5 .dropdown > ul .editsale')
            ->assertSee('Edit Users');
        $browser->driver->executeScript('window.scrollTo(0, 500);');
        $browser->type('name','Edit unittest')
            ->type('username','Edit unittestman')
            ->type('email','editunittest4.as@gmail.com')
            ->type('phone','012345678910')
            ->select('government_id','1')
            ->select('region_id','1')
            ->select('area_id','1')
            ->select('franchise_id','1')
            ->type('password','123456')
            ->pause(2000)
            ->press('Submit')
            ->pause(2000)
            ->assertSee('Users')
            ->pause(2000)
            ->visit('/dashboard/users');
    }
    public function UpdateSales($browser){
        $browser->type('name','Edit unittest')
            ->type('username','Edit unittestman')
            ->type('email','editunittest4.as@gmail.com')
            ->type('phone','012345678910')
            ->select('government_id','1')
            ->select('region_id','1')
            ->select('area_id','1')
            ->select('franchise_id','1')
            ->type('password','123456')
            ->click('.m-form__actions > .btn-primary')
            ->pause(2000)
            ->assertSee('Users');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
}
