<?php

namespace Moddable\Framework\Service;

use Moddable\Framework\Foundation\Controller;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class MiddlewareServiceProvider implements EventSubscriberInterface
{
	/**
	 * Middleware stacks
	 */
	private array $globalMiddlewares;

	public function __construct(array $globalMiddlewares)
	{
		$this->globalMiddlewares = $globalMiddlewares;
	}

	public function onKernelRequest(RequestEvent $event)
	{
		$request = $event->getRequest();

		// execute middleware one by one
		foreach ($this->globalMiddlewares as $middleware) {
			$m = new $middleware();
			$m->handle($request);
		}
	}

	public function onKernelController(ControllerEvent $event)
	{
		$controller = $event->getController();
		$request = $event->getRequest();

		// get first controller
		$controller = is_array($controller) ? $controller[0] : $controller;

		// get middleware for only controller classes, not closure
		if ($controller instanceof Controller) {
			$middlewares = $controller->getMiddlewares();

			foreach ($middlewares as $middleware) {
				$m = new $middleware();
				$m->handle($request);
			}
		}
	}

	public static function getSubscribedEvents()
	{
		return [
			KernelEvents::REQUEST => 'onKernelRequest',
			KernelEvents::CONTROLLER => 'onKernelController'
		];
	}
}
