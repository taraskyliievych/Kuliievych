<?php

namespace Kuliievych\PriceRequest\Model;

use Kuliievych\PriceRequest\Api\Data\PriceRequestInterface;
use Kuliievych\PriceRequest\Model\ResourceModel\PriceRequest as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class PriceRequest extends AbstractModel implements PriceRequestInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getRequestId()
    {
        return $this->getData(self::REQUEST_ID);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    public function getProductSku()
    {
        return $this->getData(self::PRODUCT_SKU);
    }

    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATE_AT);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    public function setProductSku($productSku)
    {
        return $this->setData(self::PRODUCT_SKU, $productSku);
    }

    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATE_AT, $createdAt);
    }
}
