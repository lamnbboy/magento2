<?php
namespace Cowell\Training\Controller\View;

use \Magento\Framework\App\Action\Action;

class Index extends Action
{
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
    )
    {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * Training Index, shows a list of recent training students.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $student_id = $this->getRequest()->getParam('student_id', $this->getRequest()->getParam('id', false));
        /** @var \Cowell\Training\Helper\Student $student_helper */
        $student_helper = $this->_objectManager->get('Cowell\Training\Helper\Student');
        $result_page = $student_helper->prepareResultStudent($this, $student_id);
        if (!$result_page) {
            $resultForward = $this->resultForwardFactory->create();
            return $resultForward->forward('noroute');
        }
        return $result_page;
    }
}