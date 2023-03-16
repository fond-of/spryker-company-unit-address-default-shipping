<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence;

use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\CompanyUnitAddressDefaultShippingDependencyProvider;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence\CompanyUnitAddressDefaultShippingRepositoryInterface getRepository()
 */
class CompanyUnitAddressDefaultShippingPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     * 
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCompanyBusinessUnitQuery(): SpyCompanyBusinessUnitQuery
    {
        return $this->getProvidedDependency(CompanyUnitAddressDefaultShippingDependencyProvider::PROPEL_QUERY_COMPANY_BUSINESS_UNIT);
    }
}
