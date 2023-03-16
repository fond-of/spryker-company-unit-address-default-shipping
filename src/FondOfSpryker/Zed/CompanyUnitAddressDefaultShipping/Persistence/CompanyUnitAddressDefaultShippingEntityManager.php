<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence\CompanyUnitAddressDefaultShippingPersistenceFactory getFactory()
 */
class CompanyUnitAddressDefaultShippingEntityManager extends AbstractEntityManager implements CompanyUnitAddressDefaultShippingEntityManagerInterface
{
    protected const PHPNAME_TABLE_MAP_DEAFAULT_SHIPPING_ADDRESS = 'DefaultShippingAddress';

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     * @param int|null $defaultShippingAddress
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveCompanyBusinessUnitDefaultShippingAddress(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer,
        ?int $defaultShippingAddress
    ): CompanyBusinessUnitTransfer
    {
        $entity = $this->getFactory()
            ->getCompanyBusinessUnitQuery()
            ->filterByIdCompanyBusinessUnit($companyBusinessUnitTransfer->getIdCompanyBusinessUnit())
            ->update(
                [
                    static::PHPNAME_TABLE_MAP_DEAFAULT_SHIPPING_ADDRESS => $defaultShippingAddress
                ]
            );

        return $companyBusinessUnitTransfer;
    }
}
