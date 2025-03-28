<?php

namespace Nufat\Nutemplete;


class Render
{
	private $templateDir;
	private $extension;
	private $variables;

	/**
	 * Constructor
	 * @param string $templateDir 
	 */
	public function __construct($templateDir, $extension = '')
	{
		$this->templateDir = $templateDir;
		$this->extension = $extension;
		$this->layout = null;
		$this->variables = array();
	}

	/**
	 * Render a template.
	 * @param string $template
	 * @return string
	 * @throws \InvalidArgumentException 
	 */
	public function render($path, array $variables = array())
	{
		$template = Template::withEnvironment($this, $path);
		return $template->render($variables);
	}

	/**
	 * Creates an empty template in this environment
	 */
	public function template()
	{
		return Template::withEnvironment($this, null);
	}

	/**
	 * Gets the path of the template in this environment
	 * @param unknown $template
	 * @return string
	 */
	public function getTemplatePath($template)
	{
		return $this->getTemplateDir() . DIRECTORY_SEPARATOR . $template . $this->getExtension();
	}

	/**
	 * Magic isset
	 * @param string $id
	 * @return boolean 
	 */
	public function __isset($id)
	{
		return isset($this->variables[$id]);
	}

	/**
	 * Magic getter
	 * @param string $id
	 * @return string
	 */
	public function __get($id)
	{
		return $this->variables[$id];
	}

	/**
	 * Magic setter
	 * @param string $id
	 * @param mixed $value 
	 */
	public function __set($id, $value)
	{
		$this->variables[$id] = $value;
	}

	/**
	 * Get the template directory
	 * @return string 
	 */
	public function getTemplateDir()
	{
		return $this->templateDir;
	}

	/**
	 * Get the extension
	 * @return string 
	 */
	public function getExtension()
	{
		return $this->extension;
	}

	/**
	 * Set the extension
	 * @param string $extension 
	 */
	public function setExtension($extension)
	{
		$this->extension = $extension;
	}
}
