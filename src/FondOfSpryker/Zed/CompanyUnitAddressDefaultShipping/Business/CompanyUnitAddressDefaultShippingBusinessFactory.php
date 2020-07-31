<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business;

use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\Model\CompanyBusinessUnitDefaultShippingAddressSaver;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\Model\CompanyBusinessUnitDefaultShippingAddressSaverInterface;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\CompanyUnitAddressDefaultShippingDependencyProvider;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CompanyUnitAddressDefaultShippingBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\Model\CompanyBusinessUnitDefaultShippingAddressSaverInterface
     */
    public function createCompanyBusinessUnitDefaultShippingAddressSaver(): CompanyBusinessUnitDefaultShippingAddressSaverInterface
    {
        return new CompanyBusinessUnitDefaultShippingAddressSaver(
            $this->getCompanyBusinessUnitFacade(),
            $this->getCompanyUnitAddressFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface
     * 
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getCompanyBusinessUnitFacade(): CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUnitAddressDefaultShippingDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getCompanyUnitAddressFacade(): CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUnitAddressDefaultShippingDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS);
    }
}
