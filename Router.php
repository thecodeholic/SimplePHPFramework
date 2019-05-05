<?php

class Router
{
    private $request;
    private $supportedHttpMethods = array(
        "GET",
        "POST"
    );

    function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    function __call($name, $args)
    {
        list($route, $method) = $args;
        if (!in_array(strtoupper($name), $this->supportedHttpMethods)) {
            return $this->invalidMethodHandler();
        }
        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }

    /**
     * Removes trailing forward slashes from the right of the route.
     * @param route (string)
     */
    private function formatRoute($route)
    {
        $result = rtrim($route, '/');
        if ($result === '') {
            return '/';
        }
        return $result;
    }

    private function invalidMethodHandler()
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    private function defaultRequestHandler()
    {
        header("{$this->request->serverProtocol} 404 Not Found");
        echo $this->renderView('_404');
    }

    /**
     * Resolves a route
     */
    function resolve()
    {
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        $formattedRoute = $this->formatRoute($this->request->requestUri);
        if (!isset($methodDictionary[$formattedRoute])) {
            return $this->defaultRequestHandler();
        }
        $method = $methodDictionary[$formattedRoute];
        if (is_null($method)) {
            $this->defaultRequestHandler();
            return;
        }

        $view = ltrim($formattedRoute, '/');
        if ($formattedRoute === '/') {
            $view = 'index';
        }
        echo $this->renderView($view);
    }

    function __destruct()
    {
        $this->resolve();
    }

    public function renderView($view)
    {
        ob_start();
        include __DIR__ . "/views/_layout.php";
        $layout = ob_get_contents();
        ob_end_clean();

        $view = __DIR__ . "/views/$view.php";
        ob_start();
        include $view;
        $content = ob_get_contents();
        ob_end_clean();
        return str_replace('{{content}}', $content, $layout);
    }
}
