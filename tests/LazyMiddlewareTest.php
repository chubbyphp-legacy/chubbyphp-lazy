<?php

namespace Chubbyphp\Tests\Lazy;

use Chubbyphp\Lazy\LazyMiddleware;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * @covers Chubbyphp\Lazy\LazyMiddleware
 */
final class LazyMiddlewareTest extends \PHPUnit_Framework_TestCase
{
    public function testInvoke()
    {
        $container = $this->getContainer([
            'service' => function (Request $request, Response $response, callable $next = null) {
                return $response;
            },
        ]);

        $request = $this->getRequest();
        $response = $this->getResponse();

        $middleware = new LazyMiddleware($container, 'service');

        self::assertSame($response, $middleware($request, $response));
    }

    /**
     * @param array $services
     *
     * @return ContainerInterface
     */
    private function getContainer(array $services): ContainerInterface
    {
        /** @var ContainerInterface|\PHPUnit_Framework_MockObject_MockObject $container */
        $container = $this->getMockBuilder(ContainerInterface::class)->setMethods(['get'])->getMockForAbstractClass();

        $container
            ->expects(self::any())
            ->method('get')
            ->willReturnCallback(function (string $id) use ($services) {
                return $services[$id];
            })
        ;

        return $container;
    }

    /**
     * @return Request|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getRequest(): Request
    {
        return $this->getMockBuilder(Request::class)->setMethods([])->getMockForAbstractClass();
    }

    /**
     * @return Response|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getResponse(): Response
    {
        return $this->getMockBuilder(Response::class)->setMethods([])->getMockForAbstractClass();
    }
}
