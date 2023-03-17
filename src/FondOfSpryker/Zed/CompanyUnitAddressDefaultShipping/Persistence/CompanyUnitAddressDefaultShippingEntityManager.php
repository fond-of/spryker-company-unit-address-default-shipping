<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence\CompanyUnitAddressDefaultShippingPersistenceFactory getFactory()
 */
class CompanyUnitAddressDefaultShippingEntityManager extends AbstractEntityManager implements CompanyUnitAddressDefaultShippingEntityManagerInterface
{
    /**
     * @var string
     */
    protected const PHPNAME_TABLE_MAP_DEAFAULT_SHIPPING_ADDRESS = 'DefaultShippingAddress';

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     * @param int|null $defaultShippingAddress
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function saveCompanyBusinessUnitDefaultShippingAddress(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer,
        ?int $defaultShippingAddress
    ): CompanyBusinessUnitTransfer {
        $entity = $this->getFactory()
            ->getCompanyBusinessUnitQuery()
            ->filterByIdCompanyBusinessUnit($companyBusinessUnitTransfer->getIdCompanyBusinessUnit())
            ->update(
                [
                    static::PHPNAME_TABLE_MAP_DEAFAULT_SHIPPING_ADDRESS => $defaultShippingAddress,
                ],
            );

        return $companyBusinessUnitTransfer;
    }
}
