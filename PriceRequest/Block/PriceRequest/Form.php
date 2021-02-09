<?php

namespace Kuliievych\PriceRequest\Block\PriceRequest;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template\Context;

class Form extends \Magento\Framework\View\Element\Template
{

    /**
     * Constructor
     *
     * @param Context  $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function index()
    {
        return __('', $this->_storeManager->getStore()->getName(), $this->getUrl('contacts'));
    }
}

