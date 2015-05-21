<?php
/**
* This file is part of the League.url library
*
* @license http://opensource.org/licenses/MIT
* @link https://github.com/thephpleague/url/
* @version 4.0.0
* @package League.url
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
namespace League\Url\Services;

use League\Url\Interfaces;
use League\Url\Url;

/**
* an URL Builder to ease URL manipulation
*
* @package League.url
* @since 4.0.0
*/
class Builder
{
    /**
     * Scheme Component
     *
     * @var Interfaces\Url
     */
    protected $url;

    /**
     * Create a new instance of URL
     *
     * @param mixed $url
     */
    public function __construct($url)
    {
        if (! $url instanceof Interfaces\Url) {
            $url = Url::createFromUrl($url);
        }

        $this->url = $url;
    }

    /**
     * Return the original URL instance
     *
     * @return Interfaces\Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Return the string representation of the URL
     *
     * @return string
     */
    public function __toString()
    {
        return $this->url->__toString();
    }

    /**
     * Return an URL with update query values
     *
     * @param Query|Traversable|array $query the data to be merged
     *
     * @return static
     */
    public function mergeQueryValues($query)
    {
        return new static($this->url->withQuery($this->url->getPart('query')->merge($query)));
    }

    /**
     * Return an URL without the submitted query parameters
     *
     * @param callable|array $query the list of parameter to remove from the query
     *                              if a callable is given it should filter the list
     *                              of parameter to remove from the query
     *
     * @return static
     */
    public function withoutQueryValues($query)
    {
        return new static($this->url->withQuery($this->url->getPart('query')->without($query)));
    }

    /**
     * Return an URL with its path appended
     *
     * @param Interfaces\CollectionComponent|string $path the data to append
     *
     * @return static
     */
    public function appendPath($path)
    {
        return new static($this->url->withPath($this->url->getPart('path')->append($path)));
    }

    /**
     * Return an URL with its path prepended
     *
     * @param Interfaces\CollectionComponent|string $path the data to prepend
     *
     * @return static
     */
    public function prependPath($path)
    {
        return new static($this->url->withPath($this->url->getPart('path')->prepend($path)));
    }

    /**
     * Return an URL with one of its Path segment replaced
     *
     * @param Interfaces\CollectionComponent|string $path   the data to inject
     * @param int                                   $offset the Path segment offset
     *
     * @return static
     */
    public function replacePathSegment($path, $offset)
    {
        return new static($this->url->withPath($this->url->getPart('path')->replace($path, $offset)));
    }

    /**
     * Return an URL without the submitted path segments
     *
     * @param callable|array $offsets the list of segments offset to remove from the Path
     *                                if a callable is given it should filter the list
     *                                of offset to remove from the Path
     *
     * @return static
     */
    public function withoutPathSegments($offsets)
    {
        return new static($this->url->withPath($this->url->getPart('path')->without($offsets)));
    }

    /**
     * Return an URL with the path extension updated
     *
     * @param  string $extension the new path extension
     *
     * @return static
     */
    public function withPathExtension($extension)
    {
        return new static($this->url->withPath($this->url->getPart('path')->withExtension($extension)));
    }

    /**
     * Return an URL with the Host appended
     *
     * @param Interfaces\CollectionComponent|string $host the data to append
     *
     * @return static
     */
    public function appendHost($host)
    {
        return new static($this->url->withHost($this->url->getPart('host')->append($host)));
    }

    /**
     * Return an URL with the Host prepended
     *
     * @param Interfaces\CollectionComponent|string $host the data to prepend
     *
     * @return static
     */
    public function prependHost($host)
    {
        return new static($this->url->withHost($this->url->getPart('host')->prepend($host)));
    }

    /**
     * Return an URL with one of its Host label replaced
     *
     * @param Interfaces\CollectionComponent|string $path   the data to inject
     * @param int                                   $offset the Host label offset
     *
     * @return static
     */
    public function replaceHostLabel($host, $offset)
    {
        return new static($this->url->withHost($this->url->getPart('host')->replace($host, $offset)));
    }

    /**
     * Return an URL without the submitted host labels
     *
     * @param callable|array $offsets the list of label offsets to remove from the Host
     *                                if a callable is given it should filter the list
     *                                of offset to remove from the Host
     *
     * @return static
     */
    public function withoutHostLabels($offsets)
    {
        return new static($this->url->withHost($this->url->getPart('host')->without($offsets)));
    }
}
