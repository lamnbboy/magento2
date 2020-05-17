<?php
namespace Cowell\Training\Controller;

class Router implements \Magento\Framework\App\RouterInterface
{
    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    protected $actionFactory;

    /**
     * Student factory
     *
     * @var \Cowell\Training\Model\StudentFactory
     */
    protected $_studentFactory;

    /**
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     * @param \Cowell\Training\Model\StudentFactory $studentFactory
     */
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Cowell\Training\Model\StudentFactory $studentFactory
    ) {
        $this->actionFactory = $actionFactory;
        $this->_studentFactory = $studentFactory;
    }

    /**
     * Validate and Match Training Student and modify request
     *
     * @param \Magento\Framework\App\RequestInterface $request
     * @return bool
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $slug = trim($request->getPathInfo(), '/training/student/');
        $slug = rtrim($slug, '/');

        /** @var \Cowell\Training\Model\Student $student */
        $student = $this->_studentFactory->create();
        $student_id = $student->checkSlug($slug);
        if (!$student_id) {
            return null;
        }

        $request->setModuleName('training')
            ->setControllerName('view')
            ->setActionName('index')
            ->setParam('student_id', $student_id);
        $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $slug);

        return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
    }
}