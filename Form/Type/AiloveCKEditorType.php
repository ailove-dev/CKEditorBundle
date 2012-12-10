<?php

namespace Ailove\CKEditorBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * CKEditor type
 *
 */
class AiloveCKEditorType extends AbstractType
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

        $resolver->setDefaults(array(
            'required'                     => false,
            'transformers'                 => $this->container->getParameter('trsteel_ckeditor.ckeditor.transformers'),
            'toolbar'                      => $this->container->getParameter('trsteel_ckeditor.ckeditor.toolbar'),
            'toolbar_groups'               => $this->container->getParameter('trsteel_ckeditor.ckeditor.toolbar_groups'),
            'startup_outline_blocks'       => $this->container->getParameter('trsteel_ckeditor.ckeditor.startup_outline_blocks'),
            'ui_color'                     => $this->container->getParameter('trsteel_ckeditor.ckeditor.ui_color'),
            'width'                        => $this->container->getParameter('trsteel_ckeditor.ckeditor.width'),
            'height'                       => $this->container->getParameter('trsteel_ckeditor.ckeditor.height'),
            'language'                     => $this->container->getParameter('trsteel_ckeditor.ckeditor.language'),
            'filebrowser_browse_url'       => $this->container->getParameter('trsteel_ckeditor.ckeditor.filebrowser_browse_url'),
            'filebrowser_upload_url'       => $this->container->getParameter('trsteel_ckeditor.ckeditor.filebrowser_upload_url'),
            'filebrowser_image_browse_url' => $this->container->getParameter('trsteel_ckeditor.ckeditor.filebrowser_image_browse_url'),
            'filebrowser_image_upload_url' => $this->container->getParameter('trsteel_ckeditor.ckeditor.filebrowser_image_upload_url') ? $this->container->getParameter('trsteel_ckeditor.ckeditor.filebrowser_image_upload_url') : $this->container->get('router')->generate('ailove_ckeditor_public_upload') ,
            'filebrowser_flash_browse_url' => $this->container->getParameter('trsteel_ckeditor.ckeditor.filebrowser_flash_browse_url'),
            'filebrowser_flash_upload_url' => $this->container->getParameter('trsteel_ckeditor.ckeditor.filebrowser_flash_upload_url'),
            'skin'                         => $this->container->getParameter('trsteel_ckeditor.ckeditor.skin'),
            'format_tags'                  => $this->container->getParameter('trsteel_ckeditor.ckeditor.format_tags'),
            'base_href'                    => $this->container->getParameter('trsteel_ckeditor.ckeditor.base_href'),
            'body_class'                   => $this->container->getParameter('trsteel_ckeditor.ckeditor.body_class'),
            'contents_css'                 => $this->container->getParameter('trsteel_ckeditor.ckeditor.contents_css'),
            'external_plugins'             => $this->container->getParameter('trsteel_ckeditor.ckeditor.external_plugins'),
        ));

        $resolver->setAllowedValues(array(
            'required'               => array(false),
            'startup_outline_blocks' => array(true, false),
        ));

        $resolver->setAllowedTypes(array(
            'transformers'   => 'array',
            'toolbar'        => 'array',
            'toolbar_groups' => 'array',
            'format_tags'    => 'array',
        ));

    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'ckeditor';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ailoveckeditor';
    }
}
