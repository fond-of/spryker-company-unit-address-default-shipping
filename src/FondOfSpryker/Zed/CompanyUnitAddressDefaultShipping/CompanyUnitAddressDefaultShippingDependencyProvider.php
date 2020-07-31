<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping;

use FondOfSpryker\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyRoleFacadeBridge;
use FondOfSpryker\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyTypeFacadeBridge;
use FondOfSpryker\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyUserFacadeBridge;
use FondOfSpryker\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToPermissionFacadeBridge;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeBridge;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompanyUnitAddressDefaultShippingDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_COMPANY_BUSINESS_UNIT = 'FACADE_COMPANY_BUSINESS_UNIT';
    public const FACADE_COMPANY_UNIT_ADDRESS = 'FACADE_COMPANY_UNIT_ADDRESS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCompanyBusinessUnitFacade($container);
        $container = $this->addCompanyUnitAddressFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyBusinessUnitFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_BUSINESS_UNIT] = static function (Container $container) {
            return new CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeBridge(
                $container->getLocator()->companyBusinessUnit()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUnitAddressFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_UNIT_ADDRESS] = static function (Container $container) {
            return new CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeBridge(
                $container->getLocator()->companyUnitAddress()->facade()
            );
        };

        return $container;
    }
}
