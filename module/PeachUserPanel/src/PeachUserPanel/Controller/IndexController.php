<?php


namespace PeachUserPanel\Controller;


use PeachUserPanel\Service\UserPanel;
use Zend\Mvc\Controller\AbstractActionController;
use ZfcDatagrid\Column;
use ZfcDatagrid\Datagrid;

class IndexController extends AbstractActionController
{
    /** @var  Datagrid */
    protected $dataGrid;

    /** @var  UserPanel */
    protected $serviceUserPanel;

    /**
     * IndexController constructor.
     * @param Datagrid $dataGrid
     * @param UserPanel $serviceUserPanel
     */
    public function __construct(Datagrid $dataGrid, UserPanel $serviceUserPanel)
    {
        $this->dataGrid = $dataGrid;
        $this->serviceUserPanel = $serviceUserPanel;
    }

    /**
     * @return array
     */
    public function indexAction()
    {
        /* @var $grid \ZfcDatagrid\Datagrid */
        $grid = $this->dataGrid;
        $grid->setTitle('user-panel grid');
        $grid->setDataSource($this->serviceUserPanel->getUserListQueryBuilder());
        $grid->setToolbarTemplate(null);

        $col = new Column\Select('usrId', 'p');
        $col->setLabel('#');
        $grid->addColumn($col);
        $col = new Column\Select('username', 'p');
        $col->setLabel('Username');
        $grid->addColumn($col);
        $col = new Column\Select('email', 'p');
        $col->addFormatter(new Column\Formatter\Email());
        $col->setLabel('email');
        $grid->addColumn($col);
        $col = new Column\Select('created', 'p');
        $col->setLabel('Created');
        $col->setType(new Column\Type\DateTime('Y-m-d H:i:s', \IntlDateFormatter::LONG));
        $grid->addColumn($col);

        $grid->render();

        return $grid->getResponse();
    }
}