<?php


namespace BroSolutions\RequestQuote\Model;


class RequestQuote extends \Magento\Framework\Model\AbstractModel implements \BroSolutions\RequestQuote\Api\Data\RequestQuoteInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'requestquote';

    protected function _construct()
    {
        $this->_init('BroSolutions\RequestQuote\Model\ResourceModel\RequestQuote');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
