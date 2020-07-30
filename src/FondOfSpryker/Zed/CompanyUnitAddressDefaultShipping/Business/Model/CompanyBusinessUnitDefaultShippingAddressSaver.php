<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\Model;

use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence\CompanyUnitAddressDefaultShippingEntityManagerInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class CompanyBusinessUnitDefaultShippingAddressSaver implements CompanyBusinessUnitDefaultShippingAddressSaverInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface
     */
    private $companyBusinessUnitFacade;

    /**
     * CompanyBusinessUnitDefaultShippingAddressSaver constructor.
     *
     * @param \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence\CompanyUnitAddressDefaultShippingEntityManagerInterface $entityManager
     */
    public function __construct(
        CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
    ) {
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    public function saveDefaultShippingAddressIdToCompanyBusinessUnit(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressResponseTransfer {

        if ($companyUnitAddressTransfer->getFkCompanyBusinessUnit()
            && $companyUnitAddressTransfer->getIsDefaultShipping()
        ) {
            $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())
                ->setIdCompanyBusinessUnit($companyUnitAddressTransfer->getFkCompanyBusinessUnit())
                ->setDefaultShippingAddress($companyUnitAddressTransfer->getIdCompanyUnitAddress());

            $companyBusinessUnitResponseTransfer = $this->companyBusinessUnitFacade->update($companyBusinessUnitTransfer);
        }

        return (new CompanyUnitAddressResponseTransfer())
            ->setCompanyUnitAddressTransfer($companyUnitAddressTransfer)
            ->setIsSuccessful(true);
    }

}
