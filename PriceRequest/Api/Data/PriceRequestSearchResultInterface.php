<?php

namespace Kuliievych\PriceRequest\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PriceRequestSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return PriceRequestInterface[]
     */
    public function getItems();

    /**
     * @param PriceRequestInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
