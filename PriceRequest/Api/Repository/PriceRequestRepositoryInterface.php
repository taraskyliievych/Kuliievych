<?php

namespace Kuliievych\PriceRequest\Api\Repository;

use Kuliievych\PriceRequest\Api\Data\PriceRequestInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Kuliievych\PriceRequest\Api\Data\PriceRequestSearchResultInterface;

interface PriceRequestRepositoryInterface
{
    /**
     * Get user by ID
     *
     * @param int $request_id
     * @throws NoSuchEntityException
     * @return PriceRequestInterface
     */
    public function getById(int $request_id) : PriceRequestInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return PriceRequestSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria) : PriceRequestSearchResultInterface;

    /**
     * @param PriceRequestInterface $request_price
     * @throws CouldNotSaveException
     * @return PriceRequestInterface
     */
    public function save(PriceRequestInterface $request_price) : PriceRequestInterface;

    /**
     * @param PriceRequestInterface $request_price
     * @throws CouldNotDeleteException
     * @return PriceRequestRepositoryInterface
     */
    public function delete(PriceRequestInterface $request_price) : PriceRequestRepositoryInterface;

    /**
     * @param int $request_id
     * @return PriceRequestRepositoryInterface
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $request_id) : PriceRequestRepositoryInterface;
}
