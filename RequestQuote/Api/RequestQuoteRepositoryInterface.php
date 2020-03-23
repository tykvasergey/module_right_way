<?php


namespace BroSolutions\RequestQuote\Api;

use BroSolutions\RequestQuote\Api\Data\RequestQuoteInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SearchCriteriaInterface;

interface RequestQuoteRepositoryInterface
{
    public function save(RequestQuoteInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(RequestQuoteInterface $page);

    public function deleteById($id);
}
