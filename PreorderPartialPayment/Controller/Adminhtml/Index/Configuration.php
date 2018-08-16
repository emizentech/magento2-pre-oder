<?php
namespace Emizentech\PreorderPartialPayment\Controller\Adminhtml\Index;

class Configuration extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	) {
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		//Call page factory to render layout and page content
		$resultPage = $this->resultPageFactory->create();

		$this->getRequest()->setParam('section','preorder');

		//Set the menu which will be active for this page
		$resultPage->setActiveMenu('Emizentech_PreorderPartialPayment::preorder');
		
		//Set the header title of grid
		$resultPage->getConfig()->getTitle()->prepend(__('Preorder Partial Payment Configuration'));

		//Add bread crumb
		// $resultPage->addBreadcrumb(__('Helloworld'), __('Helloworld'));
		// $resultPage->addBreadcrumb(__('Helloworld'), __('Manage Blogs'));

		return $resultPage;
	}

	/*
	 * Check permission via ACL resource
	*/
	
	protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Emizentech_PreorderPartialPayment::preorder');
    }
}