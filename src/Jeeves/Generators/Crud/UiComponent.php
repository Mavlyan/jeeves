<?php

namespace Mygento\Jeeves\Generators\Crud;

use Nette\PhpGenerator\PhpNamespace;

class UiComponent
{
    public function generateAdminUiIndex($uiComponent, $dataSource, $column, $addNew, $acl, $actions, $inline, $select, $editor)
    {
        $service = $this->getService();
        return $service->write('listing', function ($writer) use ($uiComponent, $dataSource, $column, $addNew, $acl, $actions, $inline, $select, $editor) {
            $writer->setIndentString('    ');
            $writer->writeAttribute(
                'xsi:noNamespaceSchemaLocation',
                'urn:magento:module:Magento_Ui:etc/ui_configuration.xsd'
            );
            $writer->write([
                [
                    'argument' => [
                        'attributes' => [
                          'name' => 'data',
                          'xsi:type' => 'array',
                        ],
                        'value' => [
                            [
                                'item' => [
                                    'attributes' => [
                                      'name' => 'js_config',
                                      'xsi:type' => 'array',
                                    ],
                                    'value' => [
                                        'item' => [
                                            'attributes' => [
                                              'name' => 'provider',
                                              'xsi:type' => 'string',
                                            ],
                                            'value' => $uiComponent . '.' . $dataSource
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'settings' => [
                        'buttons' => [
                            'button' => [
                                'attributes' => [
                                  'name' => 'add',
                                ],
                                'value' => [
                                    'url' => [
                                        'attributes' => [
                                            'path' => '*/*/new'
                                        ]
                                    ],
                                    'class' => 'primary',
                                    'label' => [
                                        'attributes' => [
                                            'translate' => 'true'
                                        ],
                                        'value' => $addNew
                                    ]
                                ]
                            ]
                        ],
                        'spinner' => $column,
                        'deps' => [
                            'dep' => $uiComponent . '.' . $dataSource
                        ]
                    ],
                    'dataSource' => [
                        'attributes' => [
                            'name' => $dataSource,
                            'component' => 'Magento_Ui/js/grid/provider'
                        ],
                        'value' => [
                            'settings' => [
                                'storageConfig' => [
                                    'param' => [
                                        'attributes' => [
                                            'name' => 'indexField',
                                            'xsi:type' => 'string',
                                        ],
                                        'value' => 'id'
                                    ],
                                ],
                                'updateUrl' => [
                                    'attributes' => [
                                        'path' => 'mui/index/render'
                                    ],
                                ]
                            ],
                            'aclResource' => $acl,
                            'dataProvider' => [
                                'attributes' => [
                                    'class' => 'Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider',
                                    'name' => $dataSource,
                                ],
                                'value' => [
                                    'settings' => [
                                        'requestFieldName' => 'id',
                                        'primaryFieldName' => 'id',
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'listingToolbar' => [
                        'massaction' => [
                            'attributes' => [
                                'name' => 'listing_massaction',
                            ],
                        ],
                        'paging' => [
                            'attributes' => [
                                'name' => 'listing_paging',
                            ],
                        ]
                    ],
                    'columns' => [
                        'attributes' => [
                            'name' => $column,
                        ],
                        'value' => [
                            'settings' => [
                                'editorConfig' => [
                                    [
                                        'name' => 'param',
                                        'attributes' => [
                                            'name' => 'clientConfig',
                                            'xsi:type' => 'array',
                                        ],
                                        'value' => [
                                            [
                                                'name' => 'item',
                                                'attributes' => [
                                                    'name' => 'saveUrl',
                                                    'xsi:type' => 'url',
                                                    'path' => $inline
                                                ],
                                            ],
                                            [
                                                'name' => 'item',
                                                'attributes' => [
                                                    'name' => 'validateBeforeSave',
                                                    'xsi:type' => 'boolean',
                                                ],
                                                'value' => 'false'
                                            ]
                                        ]
                                    ],
                                    [
                                        'name' => 'param',
                                        'attributes' => [
                                            'name' => 'indexField',
                                            'xsi:type' => 'string',
                                        ],
                                        'value' => 'id',
                                    ],
                                    [
                                        'name' => 'param',
                                        'attributes' => [
                                            'name' => 'enabled',
                                            'xsi:type' => 'boolean',
                                        ],
                                        'value' => 'true',
                                    ],
                                    [
                                        'name' => 'param',
                                        'attributes' => [
                                            'name' => 'selectProvider',
                                            'xsi:type' => 'string',
                                        ],
                                        'value' => $select
                                    ]
                                ],
                                'childDefaults' => [
                                    'param' => [
                                        'attributes' => [
                                            'name' => 'fieldAction',
                                            'xsi:type' => 'array',
                                        ],
                                        'value' => [
                                            [
                                                'name' => 'item',
                                                'attributes' => [
                                                    'name' => 'provider',
                                                    'xsi:type' => 'string',
                                                ],
                                                'value' => $editor
                                            ],
                                            [
                                                'name' => 'item',
                                                'attributes' => [
                                                    'name' => 'target',
                                                    'xsi:type' => 'string',
                                                ],
                                                'value' => 'startEdit'
                                            ],
                                            [
                                                'name' => 'item',
                                                'attributes' => [
                                                    'name' => 'params',
                                                    'xsi:type' => 'array',
                                                ],
                                                'value' => [
                                                    [
                                                        'name' => 'item',
                                                        'attributes' => [
                                                            'name' => '0',
                                                            'xsi:type' => 'string',
                                                        ],
                                                        'value' => '${ $.$data.rowIndex }'
                                                    ],
                                                    [
                                                        'name' => 'item',
                                                        'attributes' => [
                                                            'name' => '1',
                                                            'xsi:type' => 'boolean',
                                                        ],
                                                        'value' => 'true'
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ],
                                ]
                            ],
                            'selectionsColumn' => [
                                'attributes' => [
                                    'name' => 'ids'
                                ],
                                'value' => [
                                    'settings' => [
                                        'indexField' => 'id'
                                    ]
                                ]
                            ],
                            'column' => [
                                'attributes' => [
                                    'name' => 'id'
                                ],
                                'value' => [
                                    'settings' => [
                                        'filter' => 'textRange',
                                        'label' => [
                                            'attributes' => [
                                                'translate' => 'true'
                                            ],
                                            'value' => 'ID',
                                        ],
                                        'sorting' => 'asc',
                                    ]
                                ]
                            ],
                            'actionsColumn' => [
                                'attributes' => [
                                    'name' => 'actions',
                                    'class' => $actions
                                ],
                                'value' => [
                                    'settings' => [
                                        'indexField' => 'id'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
        });
    }

    public function generateAdminUiForm($uiComponent, $dataSource, $submit, $provider)
    {
        $service = $this->getService();
        return $service->write('form', function ($writer) use ($uiComponent, $dataSource, $submit, $provider) {
            $writer->writeAttribute(
                'xsi:noNamespaceSchemaLocation',
                'urn:magento:module:Magento_Ui:etc/ui_configuration.xsd'
            );
            $writer->setIndentString('    ');
            $writer->write([
                [
                    'argument' => [
                        'attributes' => [
                          'name' => 'data',
                          'xsi:type' => 'array',
                        ],
                        'value' => [
                            [
                                'item' => [
                                    'attributes' => [
                                      'name' => 'js_config',
                                      'xsi:type' => 'array',
                                    ],
                                    'value' => [
                                        [
                                            'name' => 'item',
                                            'attributes' => [
                                                'name' => 'provider',
                                                'xsi:type' => 'string',
                                            ],
                                            'value' => $uiComponent . '.' . $dataSource
                                        ],
                                    ]
                                ],
                                [
                                    'name' => 'item',
                                    'attributes' => [
                                        'name' => 'label',
                                        'xsi:type' => 'string',
                                        'translate' =>'true'
                                    ],
                                    'value' => 'General Information'
                                ],
                                [
                                    'name' => 'item',
                                    'attributes' => [
                                        'name' => 'template',
                                        'xsi:type' => 'string',
                                    ],
                                    'value' => 'templates/form/collapsible'
                                ]
                            ]
                        ]
                    ],
                    'settings' => [
                        'buttons' => [
                            [
                                'name' => 'button',
                                'attributes' => [
                                    'name' => 'save_and_continue',
                                    'class' => 'Mygento\Base\Block\Adminhtml\Component\Edit\SaveAndContinueButton',
                                ],
                            ],
                            [
                                'name' => 'button',
                                'attributes' => [
                                    'name' => 'save',
                                    'class' => 'Mygento\Base\Block\Adminhtml\Component\Edit\SaveButton',
                                ],
                            ],
                            [
                                'name' => 'button',
                                'attributes' => [
                                    'name' => 'reset',
                                    'class' => 'Mygento\Base\Block\Adminhtml\Component\Edit\ResetButton',
                                ],
                            ],
                            [
                                'name' => 'button',
                                'attributes' => [
                                    'name' => 'delete',
                                    'class' => 'Mygento\Base\Block\Adminhtml\Component\Edit\DeleteButton',
                                ],
                            ],
                            [
                                'name' => 'button',
                                'attributes' => [
                                    'name' => 'back',
                                    'class' => 'Mygento\Base\Block\Adminhtml\Component\Edit\BackButton',
                                ],
                            ],
                        ],
                        'namespace' => $uiComponent,
                        'dataScope' => 'data',
                        'deps' => [
                            'dep' => $uiComponent . '.' . $dataSource
                        ]
                    ],
                    'dataSource' => [
                        'attributes' => [
                            'name' => $dataSource,
                        ],
                        'value' => [
                            'argument' => [
                                'attributes' => [
                                    'name' => 'data',
                                    'xsi:type' => 'array',
                                ],
                                'value' => [
                                    [
                                        'item' => [
                                            'attributes' => [
                                                'name' => 'js_config',
                                                'xsi:type' => 'array',
                                            ],
                                            'value' => [
                                                [
                                                    'item' => [
                                                        'attributes' => [
                                                            'name' => 'component',
                                                            'xsi:type' => 'string',
                                                        ],
                                                        'value' => 'Magento_Ui/js/form/provider'
                                                    ]
                                                ]
                                            ],
                                        ]
                                    ]
                                ]
                            ],
                            'settings' => [
                                'submitUrl' => [
                                    'attributes' => [
                                        'path' => $submit,
                                    ],
                                ]
                            ],
                            'dataProvider' => [
                                'attributes' => [
                                    'name' => $dataSource,
                                    'class' => $provider,
                                ],
                                'value' => [
                                    'settings' => [
                                        'requestFieldName' => 'id',
                                        'primaryFieldName' => 'id',
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'fieldset' => [
                        'attributes' => [
                            'name' => 'general',
                        ],
                        'value' => [
                            'settings' => [
                                'label' => ''
                            ],
                            [
                                'name' => 'field',
                                'attributes' => [
                                    'name' => 'id',
                                    'formElement' => 'input',
                                ],
                                'value' => [
                                    'settings' => [
                                        'dataType' => 'text',
                                        'visible' => 'false',
                                        'dataScope' => 'id'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
        });
    }

    public function getActions($entity, $route, $controller, $rootNamespace, $className)
    {
        $namespace = new PhpNamespace($rootNamespace . '\Ui\Component\Listing');
        $class = $namespace->addClass($className);
        $class->setExtends('\Mygento\Base\Ui\Component\Listing\Actions');
        $class->addProperty('route', $route)
            ->setVisibility('protected');
        $class->addProperty('controller', $controller)
            ->setVisibility('protected');
        return $namespace;
    }

    public function getProvider($entity, $collection, $collectionFactory, $rootNamespace, $className, $persistor)
    {
        $namespace = new PhpNamespace($rootNamespace . '\Model\\' . ucfirst($entity));
        $namespace->addUse('Magento\Framework\App\Request\DataPersistorInterface');
        $namespace->addUse($collectionFactory);

        $class = $namespace->addClass($className);
        $class->setExtends('\Magento\Ui\DataProvider\AbstractDataProvider');
        $class->addProperty('collection')
            ->setVisibility('protected')->addComment('@var ' . $collection);
        $class->addProperty('dataPersistor')
            ->setVisibility('protected')->addComment('@var DataPersistorInterface');
        $class->addProperty('loadedData')
            ->setVisibility('protected')->addComment('@var array');

        $construct = $class->addMethod('__construct')
            ->addComment('@param \\' . $collectionFactory . ' $collectionFactory')
            ->addComment('@param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor')
            ->addComment('@param string $name')
            ->addComment('@param string $primaryFieldName')
            ->addComment('@param string $requestFieldName')
            ->addComment('@param array $meta')
            ->addComment('@param array $data')
            ->setVisibility('public');

        $construct->addParameter('collectionFactory')->setTypeHint($collectionFactory);
        $construct->addParameter('dataPersistor')->setTypeHint('\Magento\Framework\App\Request\DataPersistorInterface');
        $construct->addParameter('name');
        $construct->addParameter('primaryFieldName');
        $construct->addParameter('requestFieldName');
        $construct->addParameter('meta')->setTypeHint('array')->setDefaultValue([]);
        $construct->addParameter('data')->setTypeHint('array')->setDefaultValue([]);

        $construct->setBody('parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);' . PHP_EOL
            . '$this->collection = $collectionFactory->create();' . PHP_EOL
            . '$this->dataPersistor = $dataPersistor;');

        $getData = $class->addMethod('getData')
            ->addComment('@return array')
            ->setVisibility('public');

        $getData->setBody('if (isset($this->loadedData)) {' . PHP_EOL
            . '    return $this->loadedData;' . PHP_EOL
            . '}' . PHP_EOL
            . '$items = $this->collection->getItems();' . PHP_EOL
            . 'foreach ($items as $model) {' . PHP_EOL
            . '    $this->loadedData[$model->getId()] = $model->getData();' . PHP_EOL
            . '}' . PHP_EOL
            . '$data = $this->dataPersistor->get(\'' . $persistor . '\');' . PHP_EOL
            . 'if (!empty($data)) {' . PHP_EOL
            . '    $model = $this->collection->getNewEmptyItem();' . PHP_EOL
            . '    $model->setData($data);' . PHP_EOL
            . '    $this->loadedData[$model->getId()] = $model->getData();' . PHP_EOL
            . '    $this->dataPersistor->clear(\'' . $persistor . '\');' . PHP_EOL
            . '}' . PHP_EOL
            . 'return $this->loadedData;');
        return $namespace;
    }

    public function generateGridCollection($entity, $rootNamespace, $className, $collection)
    {
        $namespace = new PhpNamespace($rootNamespace . '\Model\\ResourceModel\\' . ucfirst($entity) . '\\Grid');
        $namespace->addUse('Magento\Framework\Api\Search\SearchResultInterface');
        $namespace->addUse('Magento\Framework\Search\AggregationInterface');
        $namespace->addUse('Magento\Framework\Api\SearchCriteriaInterface');
        $namespace->addUse($collection, 'ParentCollection');

        $class = $namespace->addClass($className);
        $class->setExtends($collection);
        $class->addImplement('Magento\Framework\Api\Search\SearchResultInterface');
        $class->addProperty('aggregations')
            ->setVisibility('protected')->addComment('@var AggregationInterface');

        $construct = $class->addMethod('__construct')
            ->addComment('@param \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory')
            ->addComment('@param \Psr\Log\LoggerInterface $logger')
            ->addComment('@param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy')
            ->addComment('@param \Magento\Framework\Event\ManagerInterface $eventManager')
            ->addComment('@param \Magento\Framework\DB\Adapter\AdapterInterface $mainTable')
            ->addComment('@param \Magento\Framework\Model\ResourceModel\Db\AbstractDb $eventPrefix')
            ->addComment('@param $eventObject')
            ->addComment('@param $resourceModel')
            ->addComment('@param string $model')
            ->addComment('@param \Magento\Framework\DB\Adapter\AdapterInterface|string|null $connection')
            ->addComment('@param \Magento\Framework\Model\ResourceModel\Db\AbstractDb|null $resource')
            ->addComment('@SuppressWarnings(PHPMD.ExcessiveParameterList)')
            ->setVisibility('public');

        $construct->addParameter('entityFactory')->setTypeHint('\Magento\Framework\Data\Collection\EntityFactoryInterface');
        $construct->addParameter('logger')->setTypeHint('\Psr\Log\LoggerInterface');
        $construct->addParameter('fetchStrategy')->setTypeHint('\Magento\Framework\Data\Collection\Db\FetchStrategyInterface');
        $construct->addParameter('eventManager')->setTypeHint('\Magento\Framework\Event\ManagerInterface');
        $construct->addParameter('mainTable');
        $construct->addParameter('eventPrefix');
        $construct->addParameter('eventObject');
        $construct->addParameter('resourceModel');
        $construct->addParameter('model')->setDefaultValue(\Magento\Framework\View\Element\UiComponent\DataProvider\Document::class);
        $construct->addParameter('connection')->setTypeHint('\Magento\Framework\DB\Adapter\AdapterInterface')->setDefaultValue(null);
        $construct->addParameter('resource')->setTypeHint('\Magento\Framework\Model\ResourceModel\Db\AbstractDb')->setDefaultValue(null);

        $construct->setBody('parent::__construct(' . PHP_EOL
            . '    $entityFactory,' . PHP_EOL
            . '    $logger,' . PHP_EOL
            . '    $fetchStrategy,' . PHP_EOL
            . '    $eventManager,' . PHP_EOL
            . '    $connection,' . PHP_EOL
            . '    $resource' . PHP_EOL
            . ');' . PHP_EOL
            . '$this->_eventPrefix = $eventPrefix;' . PHP_EOL
            . '$this->_eventObject = $eventObject;' . PHP_EOL
            . '$this->_init($model, $resourceModel);' . PHP_EOL
            . '$this->setMainTable($mainTable);');

        $getAggregations = $class->addMethod('getAggregations')
            ->addComment('@return \Magento\Framework\Search\AggregationInterface')
            ->setVisibility('public');
        $getAggregations->setBody('return $this->aggregations;');

        $setAggregations = $class->addMethod('setAggregations')
            ->addComment('@param \Magento\Framework\Search\AggregationInterface')
            ->addComment('@return $this')
            ->setVisibility('public');
        $setAggregations->addParameter('aggregations');
        $setAggregations->setBody('$this->aggregations = $aggregations;');

        $getSearchCriteria = $class->addMethod('getSearchCriteria')
            ->addComment('@return \Magento\Framework\Api\SearchCriteriaInterface|null')
            ->setVisibility('public');
        $getSearchCriteria->setBody('return null;');

        $setSearchCriteria = $class->addMethod('setSearchCriteria')
            ->addComment('@param \Magento\Framework\Search\AggregationInterface')
            ->addComment('@return $this')
            ->addComment('@SuppressWarnings(PHPMD.UnusedFormalParameter)')
            ->setVisibility('public');
        $setSearchCriteria->addParameter('searchCriteria')
            ->setTypeHint('\Magento\Framework\Api\SearchCriteriaInterface')
            ->setDefaultValue(null);
        $setSearchCriteria->setBody('return $this;');

        $getTotalCount = $class->addMethod('getTotalCount')
            ->addComment('@return int')
            ->setVisibility('public');
        $getTotalCount->setBody('return $this->getSize();');

        $setTotalCount = $class->addMethod('setTotalCount')
            ->addComment('@param int $totalCount')
            ->addComment('@return $this')
            ->addComment('@SuppressWarnings(PHPMD.UnusedFormalParameter)')
            ->setVisibility('public');
        $setTotalCount->addParameter('totalCount');
        $setTotalCount->setBody('return $this;');

        $setItems = $class->addMethod('setItems')
            ->addComment('@param \Magento\Framework\Api\ExtensibleDataInterface[] $items')
            ->addComment('@return $this')
            ->addComment('@SuppressWarnings(PHPMD.UnusedFormalParameter)')
            ->setVisibility('public');
        $setItems->addParameter('items')->setTypeHint('array')->setDefaultValue(null);
        $setItems->setBody('return $this;');

        return $namespace;
    }

    private function getService()
    {
        $service = new \Sabre\Xml\Service();
        $service->namespaceMap = ['http://www.w3.org/2001/XMLSchema-instance' => 'xsi'];
        return $service;
    }
}