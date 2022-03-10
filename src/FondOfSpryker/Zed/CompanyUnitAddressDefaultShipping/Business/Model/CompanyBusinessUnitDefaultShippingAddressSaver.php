<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\Model;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\CompaniesCompanyAddressesRestApiEvents;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\CompanyUnitAddressDefaultShippingEvents;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingiToEventFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class CompanyBusinessUnitDefaultShippingAddressSaver implements CompanyBusinessUnitDefaultShippingAddressSaverInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface
     */
    private $companyUnitAddressFacade;

    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface
     */
    private $companyBusinessUnitFacade;

    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingiToEventFacadeInterface
     */
    private $eventFacade;

    /**
     * @param \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
     * @param \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
     * @param \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingiToEventFacadeInterface $eventFacade
     */
    public function __construct(
        CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade,
        CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade,
        CompanyUnitAddressDefaultShippingiToEventFacadeInterface $eventFacade
    ) {
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
        $this->companyUnitAddressFacade = $companyUnitAddressFacade;
        $this->eventFacade = $eventFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    public function saveDefaultShippingAddressIdToCompanyBusinessUnit(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressResponseTransfer {
        if (
            $companyUnitAddressTransfer->getFkCompanyBusinessUnit()
            && $companyUnitAddressTransfer->getIsDefaultShipping()
        ) {
            $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())
                ->setIdCompanyBusinessUnit($companyUnitAddressTransfer->getFkCompanyBusinessUnit())
                ->setDefaultShippingAddress($companyUnitAddressTransfer->getIdCompanyUnitAddress());

            $companyUnitAddressCollectionTransfer = $this->getCompanyUnitAddressCollectionByIdCompanyBusinessUnit($companyBusinessUnitTransfer);
            $companyBusinessUnitTransfer->setAddressCollection($companyUnitAddressCollectionTransfer);

            $this->companyBusinessUnitFacade->update($companyBusinessUnitTransfer);
        }

        $this->triggerEvent(
            CompanyUnitAddressDefaultShippingEvents::ENTITY_SPY_COMPANY_UNIT_ADDRESS_UPDATE,
            $companyUnitAddressTransfer
        );

        return (new CompanyUnitAddressResponseTransfer())
            ->setCompanyUnitAddressTransfer($companyUnitAddressTransfer)
            ->setIsSuccessful(true);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer
     */
    protected function getCompanyUnitAddressCollectionByIdCompanyBusinessUnit(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): CompanyUnitAddressCollectionTransfer {
        $companyUnitAddressCriteriaFilterTransfer = (new CompanyUnitAddressCriteriaFilterTransfer())
            ->setIdCompanyBusinessUnit($companyBusinessUnitTransfer->getIdCompanyBusinessUnit());

        return $this->companyUnitAddressFacade->getCompanyUnitAddressCollection($companyUnitAddressCriteriaFilterTransfer);
    }

    /**
     * @param string $eventName
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return void
     */
    protected function triggerEvent(string $eventName, CompanyUnitAddressTransfer $companyUnitAddressTransfer): void
    {
        if ($this->eventFacade === null) {
            return;
        }

        $this->eventFacade->trigger($eventName, $companyUnitAddressTransfer);
    }
}
