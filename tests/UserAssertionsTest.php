<?php

use App\Entity\User;
use App\Entity\Employee;
use PHPUnit\Framework\TestCase;
use App\Tests\Http\RequestBuilder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManager;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use App\Controller\SecurityController;

Class UserAssertionsTest extends WebTestCase{

    /**
     * @test
     */  
  
    public function test_access_to_Employee_Data()
    {
        
        $client = static::createClient(array(), array(
        'PHP_AUTH_USER' => 'Brad',
        'PHP_AUTH_PW'   => 'pass',
        ));
        $crawler = $client->request('GET', '/'); 

        
        $this->assertResponseIsSuccessful();    

        //Assert access to Employee Full name       
        $this->assertTrue($crawler->filter('html:contains("Brad Williams")')->count() > 0);
        //Assert access to Employee Address
        $this->assertTrue($crawler->filter('html:contains("24 Rosemead Place, Colombo 7")')->count() > 0);
    }   

}