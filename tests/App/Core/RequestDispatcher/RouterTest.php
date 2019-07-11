<?php

namespace AppTest\Core\RequestDispatcher;

use App\Core\RequestDispatcher\Request;
use App\Core\RequestDispatcher\RequestInterface;
use App\Core\RequestDispatcher\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{


    // $router->get('/sayhello', function(RequestInterface $request) {
    //     return 'HELLO ' . $request->getQueryParam('name');
    // });
    public function testSayHello()
    {
        $request = new Request(
            'GET',
            '/sayhello',
            'https',
            'mozilla',
            [],
            ['name' => 'alex'],
            []
        );

        $router = new Router($request);
        $name = null;

        $router->get('/sayhello', function(RequestInterface $request) use (&$name) {
            $name = $request->getQueryParam('name');
        });

        $router->get('/', function(RequestInterface $request) use (&$name) {
            $name = 'should not be called';
        });

        $router->resolve();

        $this->assertEquals('alex', $name);
    }    

    public function testProfile()
    {
        $request = new Request(
            'GET',
            '/profile',
            'https',
            'mozilla',
            [],
            [],
            []
        );

        $mockProfileCall = $this->getMockBuilder(\stdClass::class)
            ->setMethods(['shouldBeCalled', 'shouldNotBeCalled'])
            ->getMock();

        $mockProfileCall->expects($this->once())
            ->method('shouldBeCalled')
            ->with($request);

        $mockProfileCall->expects($this->never())
            ->method('shouldNotBeCalled');

        $router = new Router($request);

        $router->get('/profile', [$mockProfileCall, 'shouldBeCalled']);

        $router->get('/', [$mockProfileCall, 'shouldNotBeCalled']);

        $router->resolve();
    }    

    // public function testFigureType()
    // {
    //     $request = new Request(
    //         'GET',
    //         '/figuretype',
    //         'https',
    //         'mozilla',
    //         [],
    //         [],
    //         []
    //     );

    //     $mockFigureTypeCall = $this->getMockBuilder(\stdClass::class)
    //         ->setMethods(['shouldBeCalled', 'shouldNotBeCalled'])
    //         ->getMock();

    //     $mockProfileCall->expects($this->once())
    //         ->method('shouldBeCalled')
    //         ->with($request);

    //     $mockProfileCall->expects($this->never())
    //         ->method('shouldNotBeCalled');

    //     $router = new Router($request);

    //     $router->get('/profile', [$mockProfileCall, 'shouldBeCalled']);

    //     $router->get('/', [$mockProfileCall, 'shouldNotBeCalled']);

    //     $router->resolve();
    // }    

    

}

