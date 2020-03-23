<?php


namespace BroSolutions\RequestQuote\Model\ResourceModel\RequestQuote;


class Collection  extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('BroSolutions\RequestQuote\Model\RequestQuote','BroSolutions\RequestQuote\Model\ResourceModel\RequestQuote');
    }
}
