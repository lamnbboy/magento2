<?php
namespace Cowell\Training\Helper;

use Magento\Framework\App\Action\Action;

class Student extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @var \Cowell\Training\Model\Student
     */
    protected $_student;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Cowell\Training\Model\Student $student
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Cowell\Training\Model\Student $student,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        $this->_student = $student;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Return a training student from given student id.
     *
     * @param Action $action
     * @param null $studentId
     * @return \Magento\Framework\View\Result\Page|bool
     */
    public function prepareResultStudent(Action $action, $studentId = null)
    {
        if ($studentId !== null && $studentId !== $this->_student->getId()) {
            $delimiterPosition = strrpos($studentId, '|');
            if ($delimiterPosition) {
                $studentId = substr($studentId, 0, $delimiterPosition);
            }

            if (!$this->_student->load($studentId)) {
                return false;
            }
        }

        if (!$this->_student->getId()) {
            return false;
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        // We can add our own custom page handles for layout easily.
        $resultPage->addHandle('training_student_view');

        // This will generate a layout handle like: training_student_view_id_1
        // giving us a unique handle to target specific training students if we wish to.
        $resultPage->addPageLayoutHandles(['id' => $this->_student->getId()]);

        // Magento is event driven after all, lets remember to dispatch our own, to help people
        // who might want to add additional functionality, or filter the students somehow!
        $this->_eventManager->dispatch(
            'cowell_training_student_render',
            ['student' => $this->_student, 'controller_action' => $action]
        );

        return $resultPage;
    }
}