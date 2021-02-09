<?php

namespace Kuliievych\PriceRequest\Model\Repository;

use Kuliievych\PriceRequest\Api\Data\PriceRequestInterface;
use Kuliievych\PriceRequest\Api\Data\PriceRequestSearchResultInterface;
use Kuliievych\PriceRequest\Api\Data\PriceRequestSearchResultInterfaceFactory;
use Kuliievych\PriceRequest\Api\Repository\PriceRequestRepositoryInterface;
use Kuliievych\PriceRequest\Model\PriceRequestFactory;
use Kuliievych\PriceRequest\Model\ResourceModel\PriceRequest as PriceRequestResourceModel;
use Kuliievych\PriceRequest\Model\ResourceModel\PriceRequest\CollectionFactory as PriceRequestCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class PriceRequestRepository implements PriceRequestRepositoryInterface
{
    /**
     * @var PriceRequestFactory
     */
    private $priceRequestFactory;

    /**
     * @var PriceRequestCollectionFactory
     */
    private $priceRequestCollectionFactory;

    /**
     * @var PriceRequestSearchResultInterfaceFactory
     */
    private $priceRequestSearchResultInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var PriceRequestResourceModel
     */
    private $priceRequestResourceModel;

    public function __construct(
        PriceRequestFactory $priceRequestFactory,
        PriceRequestResourceModel $priceRequestResourceModel,
        CollectionProcessorInterface $collectionProcessor,
        PriceRequestCollectionFactory $priceRequestCollectionFactory,
        PriceRequestSearchResultInterfaceFactory $priceRequestSearchResultInterfaceFactory
    ) {
        $this->priceRequestFactory = $priceRequestFactory;
        $this->priceRequestResourceModel = $priceRequestResourceModel;
        $this->collectionProcessor = $collectionProcessor;
        $this->priceRequestCollectionFactory = $priceRequestCollectionFactory;
        $this->priceRequestSearchResultInterfaceFactory = $priceRequestSearchResultInterfaceFactory;
    }
    public function getById(int $request_id): PriceRequestInterface
    {
        $priceRequest = $this->priceRequestFactory->create();
        $this->priceRequestResourceModel->load($priceRequest, $request_id);

        if (empty($priceRequest->getId())) {
            throw new NoSuchEntityException(__('Price Request id %1 not found', $request_id));
        }

        return $priceRequest;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): PriceRequestSearchResultInterface
    {
        $collection = $this->priceRequestCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->priceRequestSearchResultInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    public function save(PriceRequestInterface $priceRequest): PriceRequestInterface
    {
        try {
            $this->priceRequestResourceModel->save($priceRequest);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the Request Price: %1',
                $exception->getMessage()
            ));
        }
        return $priceRequest;
    }

    public function delete(PriceRequestInterface $priceRequest): PriceRequestRepositoryInterface
    {
        try {
            $priceRequestModel = $this->priceRequestFactory->create();
            $this->priceRequestResourceModel->load($priceRequestModel, $priceRequest->getPricerequestId());
            $this->priceRequestResourceModel->delete($priceRequestModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Request price: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById(int $priceRequestId): PriceRequestRepositoryInterface
    {
        return $this->delete($this->get($priceRequestId));
    }
}
