<?php


namespace BroSolutions\RequestQuote\Model\ResourceModel;


class RequestQuote extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('requestquote','id');
    }
}
