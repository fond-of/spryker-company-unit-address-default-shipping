<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\Model;

use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface CompanyBusinessUnitDefaultShippingAddressSaverInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer
     */
    public function saveDefaultShippingAddressIdToCompanyBusinessUnit(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressResponseTransfer;
}
