<?php


namespace BroSolutions\RequestQuote\Controller\Index;


class SubmitForm extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @var \BroSolutions\RequestQuote\Model\RequestQuoteFactory
     */
    protected $requestQuoteFactory;

    /**
     * @var \BroSolutions\RequestQuote\Helper\Data
     */
    protected $helper;

    /**
     * SubmitForm constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param \BroSolutions\RequestQuote\Model\RequestQuoteFactory $requestQuoteFactory
     * @param \BroSolutions\RequestQuote\Helper\Data $helper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \BroSolutions\RequestQuote\Model\RequestQuoteFactory $requestQuoteFactory,
        \BroSolutions\RequestQuote\Helper\Data $helper
    ) {
        $this->_pageFactory = $pageFactory;
        $this->requestQuoteFactory = $requestQuoteFactory;
        $this->helper = $helper;
        return parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $requestParams = $this->getRequest()->getParams();

        if(isset($requestParams['check_mark_options']) && is_array($requestParams['check_mark_options'])){
            $requestParams['check_mark_options'] = serialize($requestParams['check_mark_options']);
        }
        if(isset($requestParams['existing_line']) && $requestParams['existing_line'] == 1){
            $requestParams['existing_line'] = 1;
        } else {
            $requestParams['existing_line'] = 0;
        }
        if(isset($requestParams['installation'])){
            $requestParams['installation'] = (int) $requestParams['installation'];
        }
        if(isset($requestParams['comments'])){
            $requestParams['comments'] =  trim(strip_tags($requestParams['comments']));
        }

        $requestQuoteForm = $this->requestQuoteFactory->create();
        $requestQuoteForm->setData($requestParams);
        $tempData = [];

        try {
            if(isset($requestParams['interested_financing']) && $requestParams['interested_financing'] == 1){
                $requestQuoteForm->setInterestedFinancing(1);
            } else {
                $requestQuoteForm->setInterestedFinancing(0);
            }

            $now = new \DateTime();
            $requestQuoteForm->setCreatedAt($now->format('Y-m-d H:i:s'));
            $requestQuoteForm->save();
            $tempData = $requestQuoteForm->getData();
            $this->messageManager->addSuccessMessage(__("Your request has been saved."));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("An error occurred while saving request."));
        }
        if(!empty($tempData)){
            try{
                $this->helper->sendCustomerEmail($tempData);
                $this->helper->sendAdminEmail($tempData);
            }
            catch(\Exception $e){

            }
        }

        $this->_redirect('requestquoteform');
    }
}
