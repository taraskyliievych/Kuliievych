<?php

namespace Kuliievych\PriceRequest\Model;

use Kuliievych\PriceRequest\Api\Data\PriceRequestInterface;
use Kuliievych\PriceRequest\Model\ResourceModel\PriceRequest\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $contactCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $contactCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $contactCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = [];
        /** @var $request_price PriceRequestInterface */
        foreach ($items as $request_price) {
            $this->loadedData[$request_price->getId()] = $request_price->getData();
        }

        return $this->loadedData;
    }
}
