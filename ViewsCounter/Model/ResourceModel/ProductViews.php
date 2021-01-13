<?php

namespace Kuliievych\ViewsCounter\Model\ResourceModel;

/**
 * Class ProductViews
 * @package Kuliievych\ViewsCounter\Model\ResourceModel
 */
class ProductViews extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * isPkAutoIncrement variable
     *
     * @var bool
     */
    protected $_isPkAutoIncrement = false;

    /**
     * Construct
     */
    protected function _construct()
    {
        $this->_init('product_views_counter', 'product_id');
    }
}
