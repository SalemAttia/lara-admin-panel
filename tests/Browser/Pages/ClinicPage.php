<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class ClinicPage extends BasePage
{

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return 'dashboard/Clinic';
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
            ->visit('/dashboard/Clinic')
            ->assertSee('Index Clinic')
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
            ->visit('/dashboard/Clinic/create')
            ->type('name','unittest')
            ->select('government_id','1')
            ->select('region_id','1')
            ->select('area_id','1')
            ->type('address','unittestman address')
            ->type('contact','unittestman contac')
            ->select('potentiality','A+')
            ->select('loyalty','A')
            ->select('restrictions','1m')
            ->select('line','Single')
            ->type('comment','unittest4 comment')
            ->click('.btn-primary')
            ->pause(2000)
            ->assertSee('Clinic');
    }

    public function delete($browser){
        $browser->pause(2000)
            ->click('#clinic5 .dropdown > a')
            ->pause(2000)
            ->click('#clinic5 .dropdown > ul .deleteAction')
            ->pause(2000)
            ->click('#delete-form-modal .modal-footer > #deleteConfirm')
            ->pause(2000);
    }

    public function view($browser){
        $browser->pause(2000)
            ->click('#clinic4 .dropdown > a')
            ->pause(2000)
            ->click('#clinic4 .dropdown > ul .viewsale')
            ->assertSee('Show Clinic')
            ->pause(2000)
            ->visit('/dashboard/Clinic');

    }

    public function edit($browser){
        $browser->driver->executeScript('window.scrollTo(0, 500);');
        $browser->maximize()->pause(2000);
        $browser->click('#clinic3 .dropdown > a')
            ->pause(2000)
            ->click('#clinic3 .dropdown > ul .editsale')
            ->assertSee('Edit Clinic');
        $browser->driver->executeScript('window.scrollTo(0, 500);');
        $browser->type('name','unittest edit')
            ->select('government_id','1')
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
            ->assertSee('Clinic')
            ->pause(2000)
            ->visit('/dashboard/Clinic');
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
            ->assertSee('Clinic')
            ->pause(2000)
            ->visit('/dashboard/Clinic');
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
