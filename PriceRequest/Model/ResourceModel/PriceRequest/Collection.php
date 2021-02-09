<?php

namespace Kuliievych\PriceRequest\Model\ResourceModel\PriceRequest;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'request_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Kuliievych\PriceRequest\Model\PriceRequest::class,
            \Kuliievych\PriceRequest\Model\ResourceModel\PriceRequest::class
        );
    }
}
