<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

/**
 * @codeCoverageIgnore
 */
interface CompanyUnitAddressDefaultShippingEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     * @param int|null $defaultShippingAddress
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function saveCompanyBusinessUnitDefaultShippingAddress(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer,
        ?int $defaultShippingAddress
    ): CompanyBusinessUnitTransfer;
}
