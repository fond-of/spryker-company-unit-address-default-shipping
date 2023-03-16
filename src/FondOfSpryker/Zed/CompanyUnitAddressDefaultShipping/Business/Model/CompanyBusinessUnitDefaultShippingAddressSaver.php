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
     * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence\CompanyUnitAddressDefaultShippingEntityManagerInterface
     */
    private $companyUnitAddressDefaultShippingEntityManager;

    /**
     * @param \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
     * @param \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence\CompanyUnitAddressDefaultShippingEntityManagerInterface $companyUnitAddressDefaultShippingEntityManager
     */
    public function __construct(
        CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade,
        CompanyUnitAddressDefaultShippingEntityManagerInterface $companyUnitAddressDefaultShippingEntityManager
    ) {
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
        $this->companyUnitAddressDefaultShippingEntityManager = $companyUnitAddressDefaultShippingEntityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    public function saveDefaultShippingAddressIdToCompanyBusinessUnit(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressResponseTransfer {
        $companyUnitAddressResponseTransfer = (new CompanyUnitAddressResponseTransfer())
            ->setCompanyUnitAddressTransfer($companyUnitAddressTransfer)
            ->setIsSuccessful(false);

        if (!$companyUnitAddressTransfer->getFkCompanyBusinessUnit()) {
            return $companyUnitAddressResponseTransfer;
        }

        $companyBusinessUnitTransfer = $this
            ->saveCompanyBusinessUnitDefaultShippingAddress($companyUnitAddressTransfer);

        return $companyUnitAddressResponseTransfer->setIsSuccessful(true);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected function saveCompanyBusinessUnitDefaultShippingAddress(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyBusinessUnitTransfer {
        $companyBusinessUnitTransfer = $this->companyBusinessUnitFacade
            ->getCompanyBusinessUnitById(
                (new CompanyBusinessUnitTransfer())
                    ->setIdCompanyBusinessUnit($companyUnitAddressTransfer->getFkCompanyBusinessUnit()),
            );

        if (
            $companyUnitAddressTransfer->getIsDefaultShipping() &&
            ($companyBusinessUnitTransfer->getDefaultShippingAddress())
                !== $companyUnitAddressTransfer->getIdCompanyUnitAddress()
        ) {
            $companyBusinessUnitTransfer = $this->companyUnitAddressDefaultShippingEntityManager
                ->saveCompanyBusinessUnitDefaultShippingAddress(
                    $companyBusinessUnitTransfer,
                    $companyUnitAddressTransfer->getIdCompanyUnitAddress(),
                );
        }

        if (
            !$companyUnitAddressTransfer->getIsDefaultShipping() &&
            ($companyBusinessUnitTransfer->getDefaultShippingAddress()
                === $companyUnitAddressTransfer->getIdCompanyUnitAddress())
        ) {
            $companyBusinessUnitTransfer = $this->companyUnitAddressDefaultShippingEntityManager
                ->saveCompanyBusinessUnitDefaultShippingAddress($companyBusinessUnitTransfer, null);
        }

        return $companyBusinessUnitTransfer;
    }
}
