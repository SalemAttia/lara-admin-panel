<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class PharmacyPage extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return 'dashboard/Pharmacy';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->maximize();
        $browser->type('email','ahmedsalem994.as@gmail.com')
            ->type('password','123456')
            ->click('#m_login_signin_submit')
            ->visit('/dashboard/Pharmacy')
            ->assertSee('Index Pharmacy')
            ->pause(2000)
            ->waitFor('#items')
            ->pause(2000);

//        $this->createSales($browser);
//        $this->view($browser);
        $this->edit($browser);
//        $this->delete($browser);
    }

    public function createSales($browser){
        $browser->driver->executeScript('window.scrollTo(0, 500);');
        $browser->pause(2000)
            ->visit('/dashboard/Pharmacy/create')
            ->type('name','unittest')
            ->select('government_id','1')
            ->select('region_id','1')
            ->select('area_id','1')
            ->type('address','unittestman address')
            ->type('contact','unittestman contac')
            ->pause(2000)
            ->waitFor('.m-checkbox-list')
            ->pause(2000)
            ->click('#check2 .m-checkbox-list > .m-checkbox')
            ->pause(2000)
            ->click('.btn-primary')
            ->pause(2000)
            ->assertSee('Pharmacy');
    }

    public function delete($browser){
        $browser->pause(2000)
            ->click('#pharmacy5 .dropdown > a')
            ->pause(2000)
            ->click('#pharmacy5 .dropdown > ul .deleteAction')
            ->pause(2000)
            ->click('#delete-form-modal .modal-footer > #deleteConfirm')
            ->pause(2000);
    }

    public function view($browser){
        $browser->pause(2000)
            ->click('#pharmacy4 .dropdown > a')
            ->pause(2000)
            ->click('#pharmacy4 .dropdown > ul .viewsale')
            ->assertSee('Show Pharmacy')
            ->pause(2000)
            ->visit('/dashboard/Pharmacy');

    }

    public function edit($browser){
        $browser->driver->executeScript('window.scrollTo(0, 500);');
        $browser->maximize()->pause(2000);
        $browser->click('#pharmacy3 .dropdown > a')
            ->pause(2000)
            ->click('#pharmacy3 .dropdown > ul .editsale')
            ->assertSee('Edit Pharmacy');
        $browser->driver->executeScript('window.scrollTo(0, 500);');
        $browser->type('name','unittest')
            ->select('government_id','1')
            ->select('region_id','1')
            ->select('area_id','1')
            ->type('address','unittestman address')
            ->type('contact','unittestman contac')
            ->pause(2000)
            ->waitFor('.m-checkbox-list')
            ->pause(2000)
            ->click('#check2 .m-checkbox-list > .m-checkbox')
            ->click('#check3 .m-checkbox-list > .m-checkbox')
            ->pause(2000)
            ->click('.btn-primary')
            ->pause(2000)
            ->assertSee('Pharmacy');
    }
    public function UpdateSales($browser){
        $browser->select('government_id','1')
            ->select('region_id','1')
            ->select('area_id','1')
            ->type('address','unittestman address edit')
            ->type('contact','unittestman contac edit')
            ->select('potentiality','A+')
            ->select('loyalty','A')
            ->select('restrictions','1m')
            ->select('line','Single')
            ->type('comment','unittest4 comment edit')
            ->click('.btn-primary')
            ->assertSee('Pharmacy')
            ->pause(2000)
            ->visit('/dashboard/Pharmacy');
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
