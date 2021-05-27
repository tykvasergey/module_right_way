<?php
namespace BroSolutions\RequestQuote\Setup;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class InstallData
 * @package BroSolutions\RequestQuote\Setup
 */
class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{

    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * @var ObjectManagerInterface
     */
    private $_objectManager;

    /**
     * InstallData constructor.
     * @param ResourceConnection $resourceConnection
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(
        ResourceConnection $resourceConnection,
        ObjectManagerInterface $objectManager,
        \Magento\Cms\Model\PageFactory $pageFactory
    ) {
        $this->resourceConnection = $resourceConnection;
        $this->_objectManager = $objectManager;
        $this->_pageFactory = $pageFactory;
    }

    public function install(\Magento\Framework\Setup\ModuleDataSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        /**
         * Create CMS page
         */
        /*
        $page = $this->_pageFactory->create();
        $page->setTitle('Request a quote')
            ->setIdentifier('request-quote-form')
            ->setIsActive(true)
            ->setPageLayout('1column')
            ->setStores(array(0))
            ->setContent('')
            ->save();
*/
        $connection = $this->resourceConnection->getConnection();
        $query = <<<EOL
INSERT INTO `requestquote` (`id`, `created_at`, `full_name`, `email`, `city_state`, `phone`, `budget`, `part_size`, `existing_line`, `product_to_be_coated`, `installation`, `comments`, `check_mark_options`, `zipcode`, `interested_financing`) VALUES
(1,	'2019-02-21 02:04:26',	'David Harrington',	'dharrington@fabfours.com',	NULL,	'803-416-1100-1043',	'Never enough',	'Not sure',	'0',	'Aftermarket bumpers',	0,	' I need a quote for one of these hopper units please. We are looking to buy asap, just need to get the pricing figured out. ',	NULL,	'29720',	0),
(2,	'2019-03-28 02:06:25',	'JIM HOZEN',	'jh@customholesaw.com',	NULL,	'503 873-6101',	NULL,	NULL,	'0',	NULL,	0,	'please quote on the Gema Optiflex 2-Q',	NULL,	'97381',	0),
(3,	'2019-04-04 20:08:26',	'EDDIE KIM',	'ekim@haascnc.com',	NULL,	'8052781800 x5325',	NULL,	NULL,	'0',	NULL,	0,	NULL,	NULL,	'93033',	0),
(4,	'2019-04-05 07:21:46',	'Curtis Langley',	'langleymetalworks@gmail.com',	NULL,	'2547852727',	'Enough',	'Up to 48 x 96',	'0',	'Steel signs',	0,	'Can you get me price on a optiflex 2 box fed gun.  I also need 3 half pound cups. ',	'a:1:{i:0;s:1:\"1\";}',	'76457',	0),
(5,	'2019-04-30 05:37:08',	'Jayme Dauer',	'Jjdfabrication@gmail.com',	NULL,	'9895135981',	NULL,	NULL,	'0',	NULL,	0,	'Requesting a quote on a Gema Optiflex 2 Q',	'a:1:{i:0;s:1:\"1\";}',	'48657',	0),
(6,	'2019-05-01 07:20:42',	'Jake prchal ',	'tncfabricating@hotmail.com',	NULL,	'6127563290',	NULL,	'6x6x6',	'0',	'Aluminum and steel fabricated pieces',	0,	'Gemma optifelx q. Quick color change',	'a:1:{i:0;s:1:\"1\";}',	'56071',	0),
(7,	'2019-05-01 22:40:36',	'jeff stultz',	'jeff.stultz@eco-clean.com',	NULL,	'555-777-0000',	NULL,	'Gem Optiflex 2',	'0',	NULL,	0,	'Looking to replace the  old gun with a new one\r\n\r\na Gema optiflex 2  a powder coating gun',	'a:1:{i:0;s:1:\"1\";}',	'30168',	0),
(8,	'2019-05-02 23:26:29',	'Mark Metala',	'markmetala@verizon.net',	NULL,	'7244331760',	NULL,	'small parts and wheels',	'0',	'wheels and small parts',	0,	'I currently use a cup style powder coating system',	NULL,	'15146',	1),
(9,	'2019-05-10 00:41:27',	'paul',	'machine1958@yahoo.com',	NULL,	'61297553033',	NULL,	NULL,	'0',	NULL,	0,	'Hi Im looking for the 6 Gema APO1-E pumps & service kits\r\n\r\ncan you provide us with a separate price for each part. & shipping costs\r\n\r\nThankyou \r\n\r\nPaul\r\n\r\n',	NULL,	'2221',	0),
(10,	'2019-05-15 23:06:26',	'Andrew Sugar',	'asugar@vacuummetallizing.ca',	NULL,	'6474091205',	NULL,	NULL,	'0',	NULL,	0,	'Looking for pricing on a used Optiflex II manual powder gun or something compatible with the Optiflex II system.',	'a:1:{i:0;s:1:\"1\";}',	'M1S 5A7',	0),
(11,	'2019-05-22 00:47:48',	'Chuck Ulrich',	'ulrich112@tampabay.rr.com',	NULL,	'727-422-5261',	NULL,	NULL,	'0',	NULL,	0,	'i would like to receive a quote on the opetiflex 2 B part # 1007138 and the opetiflex 2 q partthank you for your time.',	NULL,	'33777',	0),
(12,	'2019-05-22 00:48:32',	'Chuck Ulrich',	'ulrich112@tampabay.rr.com',	NULL,	'727-422-5261',	NULL,	NULL,	'0',	NULL,	0,	'i would like to receive a quote on the opetiflex 2 B part # 1007138 and the opetiflex 2 q part # 1009777thank you for your time.',	NULL,	'33777',	0),
(13,	'2019-05-23 03:54:39',	'FRANCISCO diaz',	'ciscosgarageshop@msn.com',	NULL,	'6267570968',	NULL,	NULL,	'0',	NULL,	0,	'Looking to buy need a price quote and to purchase \r\n',	NULL,	'91748',	0),
(14,	'2019-05-24 02:27:20',	'francisco diaz',	'ciscosgarageshop@msn.com',	NULL,	'6267570968',	NULL,	NULL,	'0',	NULL,	0,	NULL,	NULL,	'91748',	1),
(15,	'2019-05-24 02:27:50',	'francisco diaz',	'ciscosgarageshop@msn.com',	NULL,	'6267570968',	NULL,	NULL,	'0',	NULL,	0,	NULL,	NULL,	'91748',	1),
(16,	'2019-05-24 21:30:19',	'Mike Landwehr',	'mike.landwehr@fusion-products.com',	NULL,	'4145876631',	NULL,	NULL,	'0',	'Aluminum extrusions',	0,	NULL,	'a:1:{i:0;s:1:\"1\";}',	'52052',	0),
(17,	'2019-05-28 22:36:37',	'Justin Conklin',	'justin.conklin@safetyrailcompany.com',	NULL,	'9525621874',	NULL,	NULL,	'0',	NULL,	0,	NULL,	'a:1:{i:0;s:1:\"1\";}',	'55384',	0),
(18,	'2019-06-03 08:05:52',	'Jorge Gomez',	'Jagomezr67@gmail.com',	NULL,	'9545040258',	NULL,	NULL,	'0',	NULL,	0,	NULL,	'a:1:{i:0;s:1:\"1\";}',	'33166',	0),
(19,	'2019-06-04 06:16:40',	'Darin Voss',	'dlvoss@live.com',	NULL,	'3099124217',	NULL,	NULL,	'0',	'Agriculture and auto parts',	0,	'Would like a quote for Gema Opti Flex Pro and Gema Optiflex 2. Thank you,Darin Voss Diamond In The Rough Restorations',	'a:1:{i:0;s:1:\"1\";}',	'61413',	1),
(20,	'2019-06-04 16:29:46',	'DUSTIN GULLEY',	'Dustin@Tri-statecoatings.biz',	NULL,	'8655854395',	NULL,	NULL,	'0',	NULL,	0,	'I\'m looking at upgrading to a box feed setup for my shop ',	'a:1:{i:0;s:1:\"1\";}',	'37879',	0),
(21,	'2019-06-04 16:40:27',	'Dustin Gulley',	'Dustin@Tri-statecoatings.biz',	NULL,	'8655854395',	NULL,	NULL,	'0',	NULL,	0,	'I\'m looking at adding a box feed system to my shop',	'a:1:{i:0;s:1:\"1\";}',	'37879',	0),
(22,	'2019-06-08 03:06:36',	'Chanard Cooper',	'crcooper3@gmail.com',	NULL,	'8622241524',	NULL,	NULL,	'0',	NULL,	0,	NULL,	NULL,	'07060',	1),
(23,	'2019-06-22 01:07:37',	'Michael merser',	'Apex.coatings@yahoo.com',	NULL,	'810-614-9177',	NULL,	NULL,	'0',	NULL,	0,	NULL,	NULL,	'48744',	1),
(24,	'2019-06-23 07:11:48',	'Danny Huskey',	'danhuskey@gmail.com',	NULL,	'7138536493',	NULL,	NULL,	'0',	NULL,	0,	NULL,	NULL,	'77573',	0),
(25,	'2019-07-10 15:07:46',	'Tony Valencia',	'Tony@summitcoating.com',	NULL,	'8169448916',	NULL,	NULL,	'0',	NULL,	0,	NULL,	'a:1:{i:0;s:1:\"1\";}',	'64081',	0),
(26,	'2019-07-11 07:48:47',	'Julian Barkat',	'julian@eggtoapples.com',	NULL,	'6108223670',	'NA',	'NA',	'0',	'NA',	1,	'THIS IS A TEST BY EGG TO APPLES ',	'a:1:{i:0;s:1:\"1\";}',	'19041',	1),
(27,	'2019-07-15 15:12:55',	'Deborah Matthews',	'lvsgirafs@yahoo.com',	NULL,	'336-231-9807',	NULL,	NULL,	'0',	'metal outdoor furniture',	0,	'I have an old metal glider and 2 chairs that I would like to have the layers of old paint taken off so I can repaint it. ',	NULL,	'27021',	1),
(28,	'2019-07-15 15:15:50',	'Deborah Matthews',	'lvsgirafs@yahoo.com',	NULL,	'336-231-9807',	NULL,	NULL,	'0',	'metal glider',	0,	'I have an old metal glider and 2 chairs that I would like to have the many layers of paint taken off. ',	NULL,	'27021',	1),
(29,	'2019-07-17 18:46:08',	'scott nemiro',	'scottnemiro@gmail.com',	NULL,	'4079009614',	NULL,	'24\" x 24\" x .080\"',	'0',	'18g steel metal monograms',	0,	'looking for a manual or automatic spray booth for a conveyor line. I already have the conveyor and oven ',	'a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}',	'34787',	0),
(30,	'2019-07-17 22:56:06',	'Andrew Harrell',	'Andrew@Atlantametalcoating.com',	NULL,	'6789898271',	NULL,	NULL,	'0',	NULL,	0,	NULL,	'a:1:{i:0;s:1:\"1\";}',	'30340',	0),
(31,	'2019-07-25 21:09:39',	'Jeff Kremers',	'jeff@gfcm.com',	NULL,	'320-564-1800',	NULL,	NULL,	'0',	'all',	0,	'I am looking for a new or refurbished GEMA Optiflex 2 box feed gun.',	'a:1:{i:0;s:1:\"1\";}',	'56241',	0),
(32,	'2019-07-29 17:38:38',	'Coty',	'Coty@starcodesigns.com',	NULL,	'9183459348',	NULL,	NULL,	'0',	NULL,	0,	NULL,	'a:1:{i:0;s:1:\"1\";}',	'46773',	1),
(33,	'2019-07-30 19:51:48',	'Carla Garvey',	'carla@derrys.com',	NULL,	'02838851509',	NULL,	NULL,	'0',	NULL,	2,	'Can i have a price please for OptiSelect® Manual Gun: powerful and versatile\r\n\r\nThank you ',	'a:1:{i:0;s:1:\"1\";}',	'BT62 1LX',	0),
(34,	'2019-07-31 01:45:11',	'Gregory McCullough',	'hottboy28@gmail.com',	NULL,	'3474522020',	'5000',	NULL,	'0',	'wheel',	0,	NULL,	'a:1:{i:0;s:1:\"1\";}',	'11740-1510',	0),
(35,	'2019-08-04 08:13:12',	'Danny Huskey',	'danhuskey@gmail.com',	NULL,	'7138536493',	NULL,	NULL,	'0',	NULL,	0,	NULL,	NULL,	'77573',	0),
(36,	'2019-08-05 06:48:04',	'Terp E. Oxendine',	'Terp62@myself.com',	NULL,	'910-655-4120',	'$1,000.00 and under',	NULL,	'0',	NULL,	0,	'We are a small upsetter Auto Body Shop we plan on doing small scale powder coating with the largest parts being car wheels.',	'a:1:{i:0;s:1:\"1\";}',	'28451',	0),
(37,	'2019-08-19 07:33:58',	'Amy Liu Xiaowei',	'liu.xiaowei@infratec.com',	NULL,	'+86 15000469845',	NULL,	NULL,	'0',	NULL,	0,	NULL,	'a:1:{i:0;s:1:\"3\";}',	'215400',	0),
(38,	'2019-08-22 09:37:08',	'Samuel Lokey',	'gulfstreamsolutionsllc@gmail.com',	NULL,	'9107120344',	NULL,	NULL,	'0',	NULL,	0,	'Would like a general Idea of a versatile system for different materials and applications. Would like to be able to coat MDF, Wood, Metal, I do not know if your products support those processes, but I have seen some advertisements that appeared to support  multiple options. Would me manual, not automatic. \r\nThanks ',	'a:5:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:1:\"5\";}',	'28422',	0),
(39,	'2019-08-24 02:04:49',	'adnan daadaa',	'adnan.daadaa@hotmail.com',	NULL,	'0096170033300',	'800$',	NULL,	'0',	NULL,	0,	'Im trying to open a new shop and i need your help.\r\nPlease give me a good price, i would be thankful',	'a:1:{i:0;s:1:\"1\";}',	'0005',	0),
(40,	'2019-08-26 20:43:49',	'Blade bode',	'Acecoatsllc@gmail.com',	NULL,	'5805544868',	NULL,	NULL,	'0',	NULL,	0,	'Needing a supplier for gema optiflex 2 box unit replaceable parts. ',	'a:1:{i:0;s:1:\"1\";}',	'73754',	0),
(41,	'2019-08-27 20:35:19',	'Keith Self',	'keith.self@gmail.com',	NULL,	'2054865102',	NULL,	NULL,	'0',	'PATIO FURNITURE',	1,	NULL,	'a:5:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:1:\"5\";}',	'35565',	0),
(42,	'2019-08-30 20:55:15',	'HALadzfIODJt',	'aniswoods1441@gmail.com',	NULL,	'9903648605',	'JGpXNWLQvRHI',	'ZqByTFnxoQgb',	'0',	'dQprjylXVtBz',	NULL,	NULL,	'a:1:{i:0;s:1:\"5\";}',	'tjCPyeGJfXqx',	1),
(43,	'2019-09-03 22:19:09',	'EDWARD STODDARD',	'ed@fullcurlmanufacturing.com',	NULL,	'4064714883',	NULL,	NULL,	'0',	NULL,	0,	'looking for a quote on this unit.\r\nGEMA OPTIFLEX PRO F (FLUIDIZED 50# HOPPER)',	'a:1:{i:0;s:1:\"1\";}',	'59912',	0),
(44,	'2019-09-06 21:46:53',	'JOSH WELCH',	'WELCHSCHOPSHOP@GMAIL.COM',	NULL,	'8652074088',	NULL,	NULL,	'0',	NULL,	0,	'PART NO:\r\n1009777',	'a:1:{i:0;s:1:\"1\";}',	'37777',	0),
(45,	'2019-09-26 03:55:56',	'chris',	'chriswhitaker5699@gmail.com',	NULL,	'7705842659',	NULL,	NULL,	'0',	'Rims and frames',	0,	NULL,	'a:1:{i:0;s:1:\"1\";}',	'37863',	0),
(46,	'2019-09-29 19:44:52',	'xUDGcdLBfsoQ',	'annstafford8398@gmail.com',	NULL,	'3838201445',	'ANjKadSEQbXV',	'zBVmteayijsb',	'0',	'sQDEghwHUVqA',	NULL,	NULL,	'a:1:{i:0;s:1:\"5\";}',	'tlyQZnXSBjcq',	1),
(47,	'2019-10-03 21:57:06',	'Ali Ahmed ',	'Ilmotawaset@gmail.com',	NULL,	'0916649664',	NULL,	NULL,	'0',	'Kitchen handles ',	0,	NULL,	'a:1:{i:0;s:1:\"1\";}',	'00218',	0),
(48,	'2019-10-07 17:27:59',	'Tony Gambino',	'Tony.gambino@steeladvantageaz.com',	NULL,	'602-710-2913',	NULL,	NULL,	'0',	NULL,	0,	'Looking for price and availability for Gema Optiflex 2 or Pro powder coating system delivered to Phoenix Arizona.',	'a:1:{i:0;s:1:\"1\";}',	'85331',	0),
(49,	'2019-10-14 21:11:15',	'Cody Blair',	'cblair8255@gmail.com',	NULL,	'3258955078',	'???',	'All sizes',	'0',	'Constantly changes',	0,	'Would like a quote asap. I\'m currently using KCI 201 and the color changing is killing me. Need to be more efficient with better controls',	'a:1:{i:0;s:1:\"1\";}',	'76903',	1),
(50,	'2019-10-14 22:02:16',	'Christopher Gerdmann',	'GerdmannServicesLLC@gmail.com',	NULL,	'9125477596',	NULL,	NULL,	'0',	'Automotive Parts',	0,	'Looking to just get a quote for a Gema OptiFlex Pro L.  Thanks.',	'a:1:{i:0;s:1:\"1\";}',	'31312',	0),
(51,	'2019-10-18 18:04:27',	'Matt Prince',	'matt@princedevelopmentgroup.com',	NULL,	'561-758-3308',	NULL,	NULL,	'0',	'Aluminum Railings, aluminum shutters, aluminum gates',	1,	'We have an 8,000 Sqft Empty warehouse space\r\n\r\nAlso need to know what we would need for power.\r\n\r\nAre product sizes are mainly  Railings 42\" High x 144\'\' Max\r\n\r\nSmall shutters and gates',	'a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";}',	'33404',	0),
(52,	'2019-10-19 19:22:40',	'john cote',	'topgunisme@aol.com',	NULL,	'9042372182',	NULL,	'20in rims',	'0',	'4) 20 in rims',	0,	']I have {4} 20 inch rims id like to get coated in ultra chrome',	NULL,	'32211',	0),
(53,	'2019-10-24 18:40:42',	'oscar urquiaga',	'oscar_urquiagamarquez@wgresorts.com',	NULL,	'4074664424',	'20,000',	NULL,	'0',	'79297-03',	0,	NULL,	NULL,	'32819',	0),
(54,	'2019-10-26 01:21:00',	'Brian Hoesch ',	'Brianhoesch@gmail.com',	NULL,	'8137206988',	NULL,	NULL,	'0',	NULL,	0,	'Looking for a quote on a 12×12×30 natural gas oven and  14×12×30 cartridge booth\r\n',	'a:2:{i:0;s:1:\"2\";i:1;s:1:\"3\";}',	'33605',	0),
(55,	'2019-11-07 14:58:03',	'Mack kern',	'buddy08476@gmail.com',	NULL,	'4237656910',	NULL,	NULL,	'0',	NULL,	1,	NULL,	'a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";}',	'37656',	0),
(56,	'2019-11-08 02:35:27',	'David Brown',	'dwb27@me.com',	NULL,	'865-389-6793',	'desire to discuss ',	'palatalized nest over future down draft Have a plan to discuss',	'0',	'10\"x10\" flat 1/2\" plate stacked 25 parts high with 1inch spacer height as a part separator for partial inner surface area coverage expectation is 110% edge coverage and less than total flat inner plate coverage as a product label shall cover base of plate and a second label shall cover top of steel plate',	2,	NULL,	'a:2:{i:0;s:1:\"1\";i:1;s:1:\"3\";}',	'37830',	0),
(57,	'2019-11-09 19:40:38',	'tony',	'inktat2@yahoo.com',	NULL,	'5613050477',	NULL,	'oven 8x8x12 , spray booth 8x8x8',	'0',	'rims,car parts patio furniture ,motorcycle frames & more',	1,	NULL,	'a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";}',	'33467',	0),
(58,	'2019-11-18 23:57:43',	'Carlos Garcia',	'carlos@reductioninternational.com',	NULL,	'9543037938',	NULL,	NULL,	'0',	NULL,	0,	'Please call to talk about a project\r\n\r\nThanks\r\n\r\nCarlos Garcia\r\nCel +1 954 303 7938',	'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}',	'33327',	0),
(59,	'2019-11-19 16:16:00',	'hank price',	'kwahnon123@gmail.com',	NULL,	'6064162104',	'1500',	NULL,	'0',	'auto parts  exp. tire rims',	2,	NULL,	'a:2:{i:0;s:1:\"1\";i:1;s:1:\"3\";}',	'42501',	1),
(60,	'2019-11-19 16:16:31',	'hank price',	'kwahnon123@gmail.com',	NULL,	'6064162104',	'1500',	NULL,	'0',	'auto parts  exp. tire rims',	2,	NULL,	'a:2:{i:0;s:1:\"1\";i:1;s:1:\"3\";}',	'42501',	1),
(61,	'2019-11-20 20:35:42',	'Pascal Lapointe',	'plapointe@live.ca',	NULL,	'8193454456',	NULL,	NULL,	'0',	NULL,	0,	'Hi! My name is Pascal,\r\n\r\nI\'m looking to start a powder coating shop from the scratch, I’m looking for a full turn key set-up with a 8’ x 8’ x 25’ oven, what will be your best recommandations and price range.\r\n\r\nKindest regards. \r\n\r\nPascal',	'a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";}',	'J1C 0H8',	1),
(62,	'2019-11-30 22:53:45',	'Lucas DeAtley',	'ldeatley@vt.edu',	NULL,	'4349605620',	NULL,	NULL,	'0',	'Electric motor parts',	2,	'Hello,\r\n\r\nI am looking for a quote on this coater. I\'m currently looking for an electrostatic powder coating system. Is this powder coating system electrostatic? Also, what is the maximum part size that can be fit into the machine?',	'a:1:{i:0;s:1:\"2\";}',	'24060',	0),
(63,	'2019-12-01 03:34:26',	'oMOjnxmhcHfK',	'georgemccarthy7663@gmail.com',	NULL,	'5640853660',	'pXbgWnuYqoIa',	'wKRHaFqr',	'0',	'jfODAhasyzd',	0,	'tabsmwqo',	'a:1:{i:0;s:1:\"5\";}',	'vicjBsKmZaPzCAog',	1),
(64,	'2019-12-01 03:34:29',	'lguSBCkWa',	'georgemccarthy7663@gmail.com',	NULL,	'5956747820',	'frPnLESWINa',	'uKCqFVUgfjp',	'0',	'vhRKQYVeNl',	0,	'kDIUfxEyBnLPsJiM',	'a:5:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:1:\"5\";}',	'bQhWacRkrsKwieNv',	1),
(65,	'2019-12-09 06:58:26',	'Robert Nailor ',	'bob.nailor@gmail.com',	NULL,	'207-330-8312',	NULL,	NULL,	'0',	NULL,	0,	'I would like to know price and shipping cost to the ZIP Code provided above. Thank you',	NULL,	'04250-6409',	0),
(66,	'2019-12-13 04:15:47',	'Tyson',	'Tynova66@gmail.com',	NULL,	'3139803065',	NULL,	NULL,	'0',	NULL,	0,	NULL,	NULL,	'48170',	0),
(67,	'2019-12-19 18:56:36',	'Tamara Cacio',	'tamara@ciflorida.com',	NULL,	'813-515-7349',	NULL,	'5\'x6\'x12\'',	'0',	NULL,	2,	NULL,	'a:1:{i:0;s:1:\"3\";}',	'34604',	0),
(68,	'2019-12-19 23:24:00',	'Tim',	'timreitz@yahoo.com',	NULL,	'8142290660',	NULL,	NULL,	'0',	'Motorcycle parts',	0,	'I would like a quote on a OptiFlex 2C',	'a:1:{i:0;s:1:\"1\";}',	'16235',	0),
(69,	'2019-12-31 02:31:55',	'Jason Marinzulich',	'elementpowder@gmail.com',	NULL,	'4808422987',	NULL,	NULL,	'0',	NULL,	0,	NULL,	NULL,	'85224',	0),
(70,	'2019-12-31 02:34:18',	'Jason Marinzulich',	'elementpowder@gmail.com',	NULL,	'4808422987',	NULL,	NULL,	'0',	NULL,	0,	'looking for the GEMA opti Pro box unit,  was looking to buy ASAP before the new year',	'a:1:{i:0;s:1:\"1\";}',	'85224',	0),
(71,	'2020-01-07 21:16:03',	'conor',	'conor.wall@wallsforge.ie',	NULL,	'00353879175374',	NULL,	NULL,	'0',	NULL,	0,	'Please can you provide me with a price for a new manual GEMA OptiPlex gun only ',	'a:1:{i:0;s:1:\"1\";}',	'R93H003',	0),
(72,	'2020-01-10 20:31:03',	'NlBdZjQRuUa',	'jacksnow2798@gmail.com',	NULL,	'3990492367',	'IpUfXMqtSBFuKL',	'gsOPiwYGI',	'0',	'TjGftMoHNErzQ',	0,	'bVfQSnvlG',	'a:1:{i:0;s:1:\"5\";}',	'IVlxJKqRTkaDwFS',	1),
(73,	'2020-01-10 20:31:04',	'YLBiScwAdbaQzxR',	'jacksnow2798@gmail.com',	NULL,	'9240321276',	'PlqTOSofWdg',	'mLaQesilTOCg',	'0',	'ysEOzwoj',	0,	'qyDQMNFmObSG',	'a:5:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:1:\"5\";}',	'TbANCYZzcPs',	1),
(74,	'2020-01-15 03:25:00',	'Peter Fricano',	'bigeasyblasting@gmail.com',	NULL,	'5043153275',	NULL,	NULL,	'0',	NULL,	0,	'We are looking for electric oven sizes and pricing. \r\nThank you. \r\n',	'a:2:{i:0;s:1:\"2\";i:1;s:1:\"3\";}',	'70032',	0),
(75,	'2020-01-16 23:38:56',	'Damin misior',	'Thepowdertouch@gmail.com',	NULL,	'3478212299',	NULL,	NULL,	'0',	NULL,	0,	NULL,	NULL,	'11379',	0),
(76,	'2020-01-19 17:29:32',	'KAVEH DOUSTKHAH',	'KAVEH.DOUSTKHAH@IGP-POWDER.COM',	NULL,	'8645589381',	NULL,	NULL,	'0',	NULL,	0,	'Dear Sir/Madam,\r\n\r\nJust checking to see if you have Gas oven that we can use in our powder coating laboratory? if so, please send me more info.\r\n\r\nThank you,\r\nKaveh Doustkhah',	'a:1:{i:0;s:1:\"3\";}',	'40299',	0),
(77,	'2020-01-25 09:10:36',	'scott thrasher',	'sthrasher302@yahoo.com',	NULL,	'9319933199',	NULL,	'opti flex 2 k',	'0',	NULL,	0,	NULL,	'a:1:{i:0;s:1:\"1\";}',	'37335',	0),
(78,	'2020-01-25 15:48:18',	'MGkWXtdv',	'md0480430@gmail.com',	NULL,	'6812913951',	'dLMrhAoQtquIBU',	'ClmbQfuMnEgc',	'0',	'lxkyngFCLsV',	0,	'YzLMvhxqUKNWmgB',	'a:1:{i:0;s:1:\"5\";}',	'SIZMHuhWUbFtoqTE',	1),
(79,	'2020-01-25 15:48:21',	'tmTvcMWyHPRVBZF',	'md0480430@gmail.com',	NULL,	'4561422811',	'dkHUoDuiEngvxQq',	'WwGTyNJCDmrUiEv',	'0',	'abzNjFEuKQvRt',	0,	'qPmBjszfEWptZb',	'a:5:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:1:\"5\";}',	'yONQlzZcuixY',	1),
(80,	'2020-01-26 18:52:47',	'David',	'ncdjman23@gmail.com',	NULL,	'6159307177',	NULL,	NULL,	'0',	'Wheels',	0,	NULL,	'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}',	'37089',	1),
(81,	'2020-01-28 07:46:10',	'Pedro Sarabia ',	'Sarabiapedro69@yahoo.com',	NULL,	'256 460 5104',	'3000',	NULL,	'0',	'Paint gun',	0,	NULL,	'a:1:{i:0;s:1:\"1\";}',	'35654',	0),
(82,	'2020-02-01 00:06:47',	'gregg scott',	'gscott@cpioh.com',	NULL,	'61242070089',	'10k',	'6\"',	'0',	'fasteners, door handles',	0,	'We had this unit demoed at our shop.  We received a quote.  Is Gema territorial in sales or can you quote the unit too - we are in Columbus Ohio.  I would like just the basic unit with cart quoted. e are looking to purchase within 15 days.  Thanks  As well as the powder setup we are looking at Fanuc Paint Mate arms and specifically a refurb unit that is one size larger than the 200 IA 5L\r\nGregg Scott',	NULL,	'43085',	0),
(83,	'2020-02-04 22:46:29',	'Bruce Ford',	'bruce@silverstarindustries.com',	NULL,	'5094278800',	NULL,	NULL,	'0',	NULL,	0,	NULL,	NULL,	'98639',	0),
(84,	'2020-02-05 06:26:09',	'Rick Witzke',	'Rickw@formafab.com',	NULL,	'9195635630',	NULL,	NULL,	'0',	NULL,	0,	NULL,	NULL,	'27302',	0),
(85,	'2020-02-05 20:59:31',	'ANTHONY LAPOINT',	'anthony88lapoint@gmail.com',	NULL,	'8137356447',	NULL,	NULL,	'0',	NULL,	2,	NULL,	'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}',	'33542',	1),
(86,	'2020-02-10 07:33:14',	'Kaleb Russell Reid ',	'heatherreid2@aol.com',	NULL,	'2053527966',	NULL,	NULL,	'0',	'Wheels',	2,	NULL,	NULL,	'35180',	0),
(87,	'2020-02-12 23:43:02',	'Renee Muller',	'ren.bcv@gmail.com',	NULL,	'5616830888',	NULL,	NULL,	'0',	'foam panels',	0,	'ZA07/08/15 vertical reciprocator: powerful and reliable \r\n\r\nHow much for one of these?  Not looking to build a customized machine.',	NULL,	'33411',	0),
(88,	'2020-02-13 00:58:38',	'Terry Hatfield',	'hatfieldt1@bledsoecountyschools.org',	NULL,	'423-447-6370',	NULL,	NULL,	'0',	NULL,	0,	NULL,	'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}',	'37367',	0),
(89,	'2020-02-14 22:09:02',	'Richard Haines',	'rhaines@rlh-llc.com',	NULL,	'4072761546',	'?',	'?',	'0',	'Hand rails, rims and signs ',	0,	'I’m liking to purchase a water jetting company to assist in my contracting company and think a PC set up would be a complete business \r\nNeed someone to call me to discuss ',	NULL,	'32765',	1),
(90,	'2020-02-20 14:12:05',	'Keaton Cruz Yourdon',	'Keatonyourdon@gmail.com',	NULL,	'5416470238',	NULL,	NULL,	'0',	'Everything ',	2,	'I am interested in your guy\'s gema optiflex pro q. I\'ve been coating going on 3 years now for other company\'s and I\'m starting to purchase equipment to start my own shop. Please let me know what the cost is on that, and what kind of financing if any you have. Thank you very much! ',	'a:1:{i:0;s:1:\"1\";}',	'97739',	1),
(91,	'2020-02-24 18:26:31',	'Michael Pulka',	'mjpulka@verizon.net',	NULL,	'7167255739',	NULL,	NULL,	'0',	'4 rims',	0,	NULL,	NULL,	'14221',	0),
(92,	'2020-02-25 04:46:50',	'JOEY G LONG',	'joeyglong1@msn.com',	NULL,	'9104764171',	'5,000.00',	NULL,	'0',	NULL,	0,	'I need equipment that can powder coat automotive rims and wheels',	NULL,	'28348',	0),
(93,	'2020-02-25 19:30:12',	'David Castillo',	'd.castillo23@hotmail.com',	NULL,	'8292591515',	NULL,	NULL,	'0',	NULL,	0,	'Hello,\r\n\r\nI would like to quote the OptiFlex 2B- Vibratory Box Powder Coating Unit.\r\n\r\nRegards.',	'a:1:{i:0;s:1:\"1\";}',	'10119',	0),
(94,	'2020-02-27 23:39:51',	'Stephen Mushegan',	'molochmunch@gmail.com',	NULL,	'18057574296',	'200',	'Small and medium',	'0',	'Harley 05 heritage softail classic horn coil cover pipesfoot boards carburator coverdash boardmirrors',	0,	'Therea rust on the crash bars and all other parts are chrome and id like to switch to flate black or an egg shell finish. And if i could start paying tou in advance that would be great ',	NULL,	'70737',	0),
(95,	'2020-03-01 13:51:36',	'Nikos Drougkakis',	'drougos@gmail.com',	NULL,	'6945179818',	NULL,	NULL,	'0',	NULL,	0,	NULL,	'a:1:{i:0;s:1:\"1\";}',	'71303',	0),
(96,	'2020-03-02 07:33:35',	'Matthew Cancellieri',	'themc1596@gmail.com',	NULL,	'7042307260',	NULL,	'Front bumper',	'0',	'black',	0,	'i want to buy a truck with an ugly colored bumper. What would it cost to be coated black and how long of a wait or turn around time is there?? Thank you. ',	'a:1:{i:0;s:1:\"1\";}',	'28078',	0),
(97,	'2020-03-04 19:56:15',	'Ghislain Larouche',	'ghislain.larouche@sklaluminium.com',	NULL,	'4185481881',	NULL,	NULL,	'0',	NULL,	0,	NULL,	NULL,	'g7x7v3',	0);
EOL;

        try {

            $connection->query($query);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
}
