<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\CmsStorage\Dependency\Client;

class CmsStorageToStorageClientBridge implements CmsStorageToStorageClientInterface
{
    /**
     * @var \Spryker\Client\Storage\StorageClientInterface
     */
    protected $storageClient;

    /**
     * @param \Spryker\Client\Storage\StorageClientInterface $storageClient
     */
    public function __construct($storageClient)
    {
        $this->storageClient = $storageClient;
    }

    /**
     * @param array<string> $keys
     *
     * @return array
     */
    public function getMulti(array $keys)
    {
        return $this->storageClient->getMulti($keys);
    }
}
