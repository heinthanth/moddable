<?php

namespace Moddable\Framework\Foundation;

use Moddable\Framework\Foundation\Application;
use Moddable\Framework\Http\Middleware;
use Moddable\Framework\Service\MiddlewareServiceProvider;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\ErrorListener;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Routing\RouteCollection;

class Container
{
	/**
	 * Route collection to be registered
	 */
	private RouteCollection $routes;

	/**
	 * Global middlewares
	 */
	private array $globalMiddlewares;

	/**
	 * service Container
	 */
	private ContainerBuilder $builder;

	public function __construct(RouteCollection $routes, $globalMiddlewares)
	{
		$this->routes = $routes;
		$this->globalMiddlewares = $globalMiddlewares;
		$this->builder = new ContainerBuilder();
	}

	public function bootstrap()
	{
		$this->builder->register('context', RequestContext::class);
		$this->builder->register('matcher', UrlMatcher::class)
			->setArguments([$this->routes, new Reference('context')]);
		$this->builder->register('request_stack', RequestStack::class);

		$this->builder->register('controller_resolver', ControllerResolver::class);
		$this->builder->register('argument_resolver', ArgumentResolver::class);

		$this->builder->register('listener.router', RouterListener::class)
			->setArguments([new Reference('matcher'), new Reference('request_stack')]);
		$this->builder->register('listener.exception', ErrorListener::class)
			->setArguments(['Moddable\Framework\Handler\ErrorController::exception']);
		$this->builder->register('listener.middleware', MiddlewareServiceProvider::class)
			->setArguments([$this->globalMiddlewares]);

		$this->builder->register('dispatcher', EventDispatcher::class)
			->addMethodCall('addSubscriber', [new Reference('listener.router')])
			->addMethodCall('addSubscriber', [new Reference('listener.exception')])
			->addMethodCall('addSubscriber', [new Reference('listener.middleware')]);

		$this->builder->register('application', Application::class)
			->setArguments([
				new Reference('dispatcher'),
				new Reference('controller_resolver'),
				new Reference('request_stack'),
				new Reference('argument_resolver'),
			]);

		return $this->builder;
	}
}
