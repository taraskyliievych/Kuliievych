<?php

namespace Kuliievych\ViewsCounter\Model;

/**
 * Class ProductViews
 * @package Kuliievych\ViewsCounter\Model
 */
class ProductViews extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Construct
     */
    protected function _construct()
    {
        $this->_init(\Kuliievych\ViewsCounter\Model\ResourceModel\ProductViews::class);
    }
}
