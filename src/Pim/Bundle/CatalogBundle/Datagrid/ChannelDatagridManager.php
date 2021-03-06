<?php

namespace Pim\Bundle\CatalogBundle\Datagrid;

use Oro\Bundle\GridBundle\Action\ActionInterface;
use Oro\Bundle\GridBundle\Datagrid\DatagridManager;
use Oro\Bundle\GridBundle\Field\FieldDescription;
use Oro\Bundle\GridBundle\Field\FieldDescriptionCollection;
use Oro\Bundle\GridBundle\Field\FieldDescriptionInterface;
use Oro\Bundle\GridBundle\Filter\FilterInterface;
use Oro\Bundle\GridBundle\Property\UrlProperty;
use Pim\Bundle\CatalogBundle\Manager\CategoryManager;

/**
 * Channel datagrid manager
 *
 * @author    Romain Monceau <romain@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ChannelDatagridManager extends DatagridManager
{
    /**
     * @var CategoryManager
     */
    protected $categoryManager;

    /**
     * @param CategoryManager $manager
     */
    public function setCategoryManager(CategoryManager $manager)
    {
        $this->categoryManager = $manager;
    }

    /**
     * get properties
     * @return array
     */
    protected function getProperties()
    {
        return array(
            new UrlProperty('edit_link', $this->router, 'pim_catalog_channel_edit', array('id')),
            new UrlProperty('delete_link', $this->router, 'pim_catalog_channel_remove', array('id'))
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFields(FieldDescriptionCollection $fieldsCollection)
    {
        $field = new FieldDescription();
        $field->setName('code');
        $field->setOptions(
            array(
                'type'        => FieldDescriptionInterface::TYPE_TEXT,
                'label'       => $this->translate('Code'),
                'field_name'  => 'code',
                'filter_type' => FilterInterface::TYPE_STRING,
                'required'    => false,
                'sortable'    => true,
                'filterable'  => true,
                'show_filter' => true,
            )
        );
        $fieldsCollection->add($field);

        $field = new FieldDescription();
        $field->setName('name');
        $field->setOptions(
            array(
                'type'        => FieldDescriptionInterface::TYPE_TEXT,
                'label'       => $this->translate('Name'),
                'field_name'  => 'name',
                'filter_type' => FilterInterface::TYPE_STRING,
                'required'    => false,
                'sortable'    => true,
                'filterable'  => true,
                'show_filter' => true,
            )
        );
        $fieldsCollection->add($field);

        $trees = $this->categoryManager->getTrees();
        $choices = array();
        foreach ($trees as $tree) {
            $choices[$tree->getId()] = $tree->getTitle();
        }

        $field = new FieldDescription();
        $field->setName('category');
        $field->setOptions(
            array(
                'type'          => FieldDescriptionInterface::TYPE_TEXT,
                'label'         => $this->translate('Category tree'),
                'field_name'    => 'category',
                'filter_type'   => FilterInterface::TYPE_CHOICE,
                'required'      => false,
                'sortable'      => true,
                'filterable'    => true,
                'show_filter'   => true,
                'field_options' => array(
                    'choices' => $choices
                ),
            )
        );
        $fieldsCollection->add($field);
    }

    /**
     * {@inheritdoc}
     */
    protected function getRowActions()
    {
        $editAction = array(
            'name'         => 'edit',
            'type'         => ActionInterface::TYPE_REDIRECT,
            'acl_resource' => 'root',
            'options'      => array(
                'label'   => $this->translate('Edit'),
                'icon'    => 'edit',
                'link'    => 'edit_link'
            )
        );

        $clickAction = $editAction;
        $clickAction['name'] = 'rowClick';
        $clickAction['options']['runOnRowClick'] = true;

        $deleteAction = array(
            'name'         => 'delete',
            'type'         => ActionInterface::TYPE_DELETE,
            'acl_resource' => 'root',
            'options'      => array(
                'label' => $this->translate('Delete'),
                'icon'  => 'trash',
                'link'  => 'delete_link'
            )
        );

        return array($clickAction, $editAction, $deleteAction);
    }

    /**
     * @inheritdoc
     */
    public function getIdentifierField()
    {
        return 'id';
    }
}
