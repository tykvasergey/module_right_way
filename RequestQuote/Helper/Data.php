<?php

namespace BroSolutions\RequestQuote\Helper;


use Magento\Framework\App\Helper\Context;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    const CONFIG_PATH = 'requestquote/request_quote/';

    protected $_checkMarkOptions = array('1' => 'Gun', '2' => 'Booth', '3' => 'Oven', '4' => 'Washer', '5' => 'Conveyor');

    public function __construct(
        Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
    ) {
        parent::__construct($context);
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $inlineTranslation;
        $this->transportBuilder = $transportBuilder;
    }

    /**
     * @return array
     */
    public function getCheckMarkOptions()
    {
        return $this->_checkMarkOptions;
    }

    /**
     * @param $templateParams
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function sendCustomerEmail($templateParams)
    {
        $sender = [
            'name' => $this->getConfig('from_name'),
            'email' => $this->getConfig('from_email'),
        ];
        $templateId = $this->getConfig('template_id');
        $templateParams['subject'] = $this->getConfig('email_subject');
        $transport = $this->transportBuilder->setTemplateIdentifier($templateId)
            ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => 1])
            ->setTemplateVars(['data' => $templateParams])
            ->setFrom($sender)
            ->addTo($templateParams['email'])
            ->getTransport();
        try {
            $transport->sendMessage();
        } catch (\Exception $e) {

        }
    }

    /**
     * @param $templateParams
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function sendAdminEmail($templateParams)
    {
        $variablesoptionsToSend = array();
        if(isset($templateParams['check_mark_options'])){
            $checkMarkOptions = unserialize($templateParams['check_mark_options']);
            foreach($checkMarkOptions as $option){
                $variablesoptionsToSend['check_mark_option_'.$option] = 'Yes';
            }
        }
        $variablesoptionsToSend = array_merge($templateParams, $variablesoptionsToSend);
        foreach($variablesoptionsToSend as $key => $value){
            if(empty($variablesoptionsToSend[$key])){
                unset($variablesoptionsToSend[$key]);
            }
            if($key == 'email'){
                $variablesoptionsToSend['customer_email'] = $value;
            }
            if($key == 'installation'){
                if(empty($variablesoptionsToSend[$key]) || $variablesoptionsToSend[$key] == 0){
                    $variablesoptionsToSend[$key] = 'No';
                }
                if($variablesoptionsToSend[$key] == 1){
                    $variablesoptionsToSend[$key] = 'Yes';
                }
                if($variablesoptionsToSend[$key] == 2){
                    $variablesoptionsToSend[$key] = 'Quote both ways';
                }
            }
        }

        $sender = [
            'name' => $this->getConfig('from_name'),
            'email' => $this->getConfig('from_email'),
        ];
        $templateId = $this->getConfig('admin_template_id');
        $templateParams['subject'] = $this->getConfig('email_subject');
        $transport = $this->transportBuilder->setTemplateIdentifier($templateId)
            ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => 1])
            ->setTemplateVars(['data' => $variablesoptionsToSend])
            ->setFrom($sender)
            ->addTo($this->getConfig('to_email'))
            ->getTransport();
        try {
             $transport->sendMessage();
        } catch (\Exception $e) {

        }
    }

    /**
     * @param $config_path
     * @return mixed
     */
    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            self::CONFIG_PATH . $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @param $value
     * @return string
     */
    public function formatPresentations($value)
    {
        $conferencesArray = $this->getAssociatedAvailablePresentations();
        $checkedConferencesStr = $value;
        $valueToDisplayArr = [];
        if (!empty($checkedConferencesStr) && strpos($checkedConferencesStr, ',') !== false) {
            $checkedConferencesArr = explode(',', $checkedConferencesStr);
            foreach ($checkedConferencesArr as $key) {
                if (isset($conferencesArray[$key])) {
                    $valueToDisplayArr[] = $conferencesArray[$key];
                }
            }
        }
        return implode(', ', $valueToDisplayArr);
    }
}
