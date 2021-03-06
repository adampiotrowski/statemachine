<?php

/*
* This file is part of the StateMachine package
*
* (c) Michal Wachowski <wachowski.michal@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace StateMachine\Renderer;

/**
 * Process
 *
 * @package StateMachine
 */
final class Document implements DotInterface
{
    /**
     * Document name
     *
     * @var string
     */
    private $name;

    /**
     * Document density
     *
     * @var int
     */
    private $dpi;

    /**
     * Font style
     *
     * @var string
     */
    private $font;

    /**
     * List of states
     *
     * @var DotInterface[]
     */
    private $states = [];

    /**
     * List of edges
     *
     * @var DotInterface[]
     */
    private $edges = [];

    /**
     * Constructor
     *
     * @param string $name document name
     * @param int    $dpi  density
     * @param string $font font family
     */
    public function __construct($name, $dpi = 75, $font = 'Courier')
    {
        $this->name = $name;
        $this->dpi = (int) $dpi;
        $this->font = $font;
    }

    /**
     * Add state to process
     *
     * @param DotInterface $state
     */
    public function addState(DotInterface $state)
    {
        $this->states[] = $state;
    }

    /**
     * Add state to process
     *
     * @param DotInterface $path
     */
    public function addEdge(DotInterface $path)
    {
        $this->edges[] = $path;
    }

    /**
     * Return dot element string representation
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            'digraph %1$s {dpi="%2$s";pad="1";fontname="%3$s";nodesep="1";rankdir="TD";ranksep="0.5";%4$s%5$s}',
            $this->name,
            $this->dpi,
            $this->font,
            implode($this->states),
            implode($this->edges)
        );
    }
}
