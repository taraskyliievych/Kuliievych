<?php

namespace Kuliievych\ViewsCounter\Block\Catalog\Product\View;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Phrase;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class ViewsCounter
 * @package Kuliievych\ViewsCounter\Block\Catalog\Product\View
 */
class ViewsCounter extends \Magento\Framework\View\Element\Template
{
    /**
     * productRepository variable
     *
     * @var
     */
    protected $_productRepository;

    /**
     * ViewsCounter constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * @return Phrase
     */
    public function calculateViewsCounter()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $product = $objectManager->get('Magento\Framework\Registry')->registry('current_product');
        $productID = $product->getId();
        $objectManager = ObjectManager::getInstance();
        $counter = $objectManager->create('\Kuliievych\ViewsCounter\Model\ProductViews');
        $counter->load($productID);
        $viewCounter = $counter->getData('views');

        if (empty($viewCounter)) {
            $viewCounter = 1;
        } else {
            $viewCounter++;
        }

        $counter->setData([
            "product_id" => $productID,
            "views" => $viewCounter,
        ]);
        $counter->save();

        return __($viewCounter);
    }
}
