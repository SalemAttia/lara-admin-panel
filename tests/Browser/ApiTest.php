<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    protected function headers()
    {
        $headers = ['Accept' => 'application/json'];
        $headers['Authorization'] = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImUxOTdmOTk5NWQ4NDE4NGExNjY5YmVmODdlOWFmZTk5MWQ4OWE2Mzg1NzcyMDQ2Njk0ZjJiZjQ3Mjc4NTRjNWU4MjhlNWY1ODYyYWY5MTI0In0.eyJhdWQiOiIxIiwianRpIjoiZTE5N2Y5OTk1ZDg0MTg0YTE2NjliZWY4N2U5YWZlOTkxZDg5YTYzODU3NzIwNDY2OTRmMmJmNDcyNzg1NGM1ZTgyOGU1ZjU4NjJhZjkxMjQiLCJpYXQiOjE1MjA0MjMyODQsIm5iZiI6MTUyMDQyMzI4NCwiZXhwIjoxNTUxOTU5Mjg0LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.w9r4sPSKM_YEgK5aixzbWlRe-fmpD10vFbvnHjYlUdWshLIpUWyv2lk_GyaPfafsZwtg8CY-HXkm8pfrOb3GCKNEzHhdt8iWt35J1Ep4yLskfYrrNVlvgDlVN3DBpHSnScE-esygV5gsG3OpgCOXSLw4A8UgK6d4LYvufaAcZstWP_MeH3n2jutSp2le-jsuQIe4TASD_zPpKY9ao1ywUExxtCsUofe8wm9Kwsbl5BIiKuBM8RpMgQKLaxu7JgdIN3t0x5i8bAbLJPDAZ64BrXHkhNGR-gZAbbLIO5KtlfLkJRvlnagIorHYJbnJgyQYO6G_O43zDMozrQSEI0SlsG9vLR2TszwuvnDMlrwtfnQtgV10bAzMW-uNqQalWan848juVglnimkWJbxkA1v5Qil-7VmwS9TEazAy2TYZgjzTdNq_m3ezaKU-jQNFlJAEbE3qfr6-Qel5mx95XNu2_23ycrNRld4a-4IFKRJbFibxapnQDuRC4tbac3BZLThT0vskuzeug5brtnGWnd1J_OFVV0efhRESc-AihFOTFR91DYA2u_eqEggqD8hwc-Ne5xvHc7U5xY2AWYslWKZldTB6TL6oA9Wl7UCErsipZp6Z9zllpmzs-HaxTNy2KoMeTwFyRdUgyRTMDsdiTwFvBjuSipOGwxTSv6ohbqBMA-E';

        return $headers;
    }

    public function testExample()
    {
        $this->ReturnAll();
        $this->createClinics();
        $this->getByIdClinics();
        $this->updateClinic();

    }
    public function ReturnAll(){
        $response = $this->json('POST','api/v1/getAllClinics',['limit' => 10,'offset' => 0],$this->headers());
        $response
            ->assertStatus(200)
            ->assertJson([
                "Clinics" => []
            ]);
    }

    public function createClinics(){
        $response = $this->json('POST','api/v1/createClinicItem',['name' => 'newonefortest','region_id' => 1,'area_id'  => 1,'government_id'  => 1,'address'  => "testAddress",'contact'  => "testContact",'loyalty'  => "A",'potentiality'  => "A",'restrictions'  => "m",'line'  => "double",'comment'  => "this from test case"],$this->headers());
        $response
            ->assertStatus(200);
    }

    public function getByIdClinics(){
        $response = $this->json('POST','api/v1/getByIdClinics',['id' => 2],$this->headers());
        $response
            ->assertStatus(200)
            ->assertJson([
                "status" => 0,
                "data" => [],
                "message" => "Successful"
            ]);
    }

    public function updateClinic(){

        $response = $this->json('POST','api/v1/updateClinicItem',['id' => 1,'name' => 'newonefortest edits','region_id' => 1,'area_id'  => 1,'government_id'  => 1,'address'  => "testAddress",'contact'  => "testContact",'loyalty'  => "A",'potentiality'  => "A",'restrictions'  => "m",'line'  => "double",'comment'  => "this from test case"],$this->headers());
        $response
            ->assertStatus(200);
    }

}
