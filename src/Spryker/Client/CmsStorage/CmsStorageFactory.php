<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\CmsStorage;

use Spryker\Client\CmsStorage\Dependency\Client\CmsStorageToStorageClientInterface;
use Spryker\Client\CmsStorage\Dependency\Client\CmsStorageToStoreClientInterface;
use Spryker\Client\CmsStorage\Dependency\Service\CmsStorageToUtilEncodingServiceInterface;
use Spryker\Client\CmsStorage\Mapper\CmsPageStorageMapper;
use Spryker\Client\CmsStorage\Reader\CmsPageStorageReader;
use Spryker\Client\CmsStorage\Reader\CmsPageStorageReaderInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CmsStorageFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Client\CmsStorage\Mapper\CmsPageStorageMapperInterface
     */
    public function createCmsPageStorageMapper()
    {
        return new CmsPageStorageMapper();
    }

    public function createCmsPageStorageReader(): CmsPageStorageReaderInterface
    {
        return new CmsPageStorageReader(
            $this->getStorageClient(),
            $this->getSynchronizationService(),
            $this->getUtilEncodingService(),
        );
    }

    /**
     * @return \Spryker\Client\CmsStorage\Dependency\Service\CmsStorageToSynchronizationServiceInterface
     */
    public function getSynchronizationService()
    {
        return $this->getProvidedDependency(CmsStorageDependencyProvider::SERVICE_SYNCHRONIZATION);
    }

    public function getStorageClient(): CmsStorageToStorageClientInterface
    {
        return $this->getProvidedDependency(CmsStorageDependencyProvider::CLIENT_STORAGE);
    }

    public function getUtilEncodingService(): CmsStorageToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(CmsStorageDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    public function getStoreClient(): CmsStorageToStoreClientInterface
    {
        return $this->getProvidedDependency(CmsStorageDependencyProvider::CLIENT_STORE);
    }
}
