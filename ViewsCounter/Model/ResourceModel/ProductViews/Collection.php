<?php

namespace Kuliievych\ViewsCounter\Model\ResourceModel\ProductViews;

/**
 * Class Collection
 * @package Kuliievych\ViewsCounter\Model\ResourceModel\ProductViews
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Construct
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init(
            'Kuliievych\ViewsCounter\Model\ProductViews',
            'Kuliievych\ViewsCounter\Model\ResourceModel\ProductViews'
        );
    }
}
