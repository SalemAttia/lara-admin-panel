<?php

namespace Tests\Browser;

use Tests\Browser\Pages\ClinicPage;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TestClinic extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu'
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
            ChromeOptions::CAPABILITY, $options
        )
        );
    }



    public function testlogpage(){

        $this->browse(function (Browser $browser) {
            $browser->visit(new ClinicPage);

        });

    }
}
