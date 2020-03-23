<?php


namespace BroSolutions\RequestQuote\Ui\Component\Listing\DataProviders;


class RequestQuote extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \BroSolutions\RequestQuote\Model\ResourceModel\RequestQuote\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}
