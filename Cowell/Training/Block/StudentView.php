<?php
namespace Cowell\Training\Block;

class StudentView extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Cowell\Training\Model\Student $student
     * @param \Cowell\Training\Model\StudentFactory $studentFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Cowell\Training\Model\Student $student,
        \Cowell\Training\Model\StudentFactory $studentFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_student = $student;
        $this->_studentFactory = $studentFactory;
    }

    /**
     * @return \Cowell\Training\Model\Student
     */
    public function getStudent()
    {
        // Check if students has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'students' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData('student')) {
            if ($this->getStudentId()) {
                /** @var \Cowell\Training\Model\Student $page */
                $student = $this->_studentFactory->create();
            } else {
                $student = $this->_student;
            }
            $this->setData('student', $student);
        }
        return $this->getData('student');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\Cowell\Training\Model\Student::CACHE_TAG . '_' . $this->getStudent()->getId()];
    }

}