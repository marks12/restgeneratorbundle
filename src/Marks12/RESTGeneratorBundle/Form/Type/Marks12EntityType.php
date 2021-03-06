<?php


namespace Marks12\RESTGeneratorBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Marks12\RESTGeneratorBundle\Form\DataTransformer\ArrayToIdTransformer;

/**
 * Class Marks12EntityType
 * @package Marks12\RESTGeneratorBundle\Form\Type
 */
class Marks12EntityType extends EntityType
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     */

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $view_transformer = new ArrayToIdTransformer($this->em, null);
        $builder->addViewTransformer($view_transformer);
//        $model_transformer = new UserToUsernameTransformer()
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'invalid_message' => 'The selected entity does not exist',
            )
        );
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return 'entity';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'marks12_entity';
    }
}
