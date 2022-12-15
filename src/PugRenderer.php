<?php

namespace Slim\Views;

use \Psr\Http\Message\ResponseInterface as Response;
use \Tale\Pug\Renderer;

class PugRenderer
{
	public function __construct($path = './views')
	{
		$this->internalRenderer = new Renderer();
		$this->addPath($path);
	}

	/**
	 * @var Renderer pug renderer
	 */
	private $internalRenderer;

	public function addPath($dirPath)
	{
		$this->internalRenderer->addPath($dirPath);
	}

	public function fetch($templateName, array $data = [])
	{
		$source = $this->internalRenderer->render($templateName, $data);
		
		return $source;
	}

	public function render(Response $response, $templateName, array $data = [])
	{
		$source = $this->fetch($templateName, $data);

		$body = $response->getBody();
		$body->write($source);
		
		return $response->withBody($body);
	}
}
