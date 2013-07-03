<?php

namespace Squirrel\Context;

/**
 * Context aware class allowing dependencies injection via a container.
 *
 * @package Squirrel\Context
 * @author Valérian Galliat
 */
class ContextAware
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @param Context $context
     */
    public function setContext(Context $context)
    {
        $this->context = $context;
    }

    /**
     * Requires a context object.
     *
     * @throws \RuntimeException If no context is present.
     */
    protected function requireContext()
    {        
        if (!isset($this->context)) {
            throw new \RuntimeException(sprintf('A context is required for the the class "%s".', get_class($this)));
        }
    }
}
