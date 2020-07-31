<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade;

use Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCriteriaFilterTransfer;

interface CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressCriteriaFilterTransfer $criteriaFilterTransfer
     * 
     * @return \Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer
     */
    public function getCompanyUnitAddressCollection(
        CompanyUnitAddressCriteriaFilterTransfer $criteriaFilterTransfer
    ): CompanyUnitAddressCollectionTransfer;
}
