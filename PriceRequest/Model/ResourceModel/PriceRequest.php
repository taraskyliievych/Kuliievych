<?php

namespace Kuliievych\PriceRequest\Model\ResourceModel;

class PriceRequest extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('price_request', 'request_id');
    }
}
