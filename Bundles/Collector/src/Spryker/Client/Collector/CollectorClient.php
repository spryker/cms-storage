<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Client\Collector;

use Spryker\Client\Kernel\AbstractClient;
use Spryker\Client\Collector\Matcher\UrlMatcherInterface;

/**
 * @todo Rename all YvesExport Bundles to PageExport or just Export.
 *
 * @method CollectorDependencyContainer getDependencyContainer()
 */
class CollectorClient extends AbstractClient implements UrlMatcherInterface
{

    /**
     * @param $url
     * @param $localeName
     */
    public function matchUrl($url, $localeName)
    {
        return $this->getDependencyContainer()->createUrlMatcher()->matchUrl($url, $localeName);
    }

}