<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business;

use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface CompanyUnitAddressDefaultShippingFacadeInterface
{
    /**
     * Specification:
     *  - Save Default Shipping Id to Company Business Unit.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    public function saveDefaultShippingAddressIdToCompanyBusinessUnit(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressResponseTransfer;
}
