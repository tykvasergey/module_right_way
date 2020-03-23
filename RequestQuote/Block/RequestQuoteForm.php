<?php


namespace BroSolutions\RequestQuote\Block;


use Magento\Framework\View\Element\Template;

class RequestQuoteForm extends \Magento\Framework\View\Element\Template
{
    /**
     * @var BroSolutions\RequestQuote\Helper\Data|\BroSolutions\RequestQuote\Helper\Data
     */
    protected $dataHelper;

    /**
     * @var \Magento\Config\Model\Config\Source\Yesno
     */
    protected $yesno;

    /**
     * @var \BroSolutions\RequestQuote\Model\Config\Source\InstallationSelect
     */
    protected $installationSelect;

    /**
     * RequestQuoteForm constructor.
     * @param Template\Context $context
     * @param BroSolutions\RequestQuote\Helper\Data $dataHelper
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \BroSolutions\RequestQuote\Helper\Data $dataHelper,
        \Magento\Config\Model\Config\Source\Yesno $yesno,
        \BroSolutions\RequestQuote\Model\Config\Source\InstallationSelect $installationSelect,
        array $data = []
    ) {
        $this->dataHelper = $dataHelper;
        $this->yesno = $yesno;
        $this->installationSelect = $installationSelect;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getCheckMarkOptions()
    {
        return $this->dataHelper->getCheckMarkOptions();
    }

    /**
     * @return array
     */
    public function getYesno()
    {
        return $this->yesno->toArray();
    }

    /**
     * @return array
     */
    public function getInstallationOptions()
    {
        return $this->installationSelect->toArray();
    }

    /**
     * Returns action url for contact form
     *
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('requestquoteform/index/submitform');
    }
}
