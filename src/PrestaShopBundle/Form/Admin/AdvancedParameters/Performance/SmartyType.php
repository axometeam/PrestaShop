<?php
/**
 * 2007-2019 PrestaShop SA and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

namespace PrestaShopBundle\Form\Admin\AdvancedParameters\Performance;

use PrestaShopBundle\Form\Admin\Type\SwitchType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * This form class generates the "Smarty" form in Performance page.
 */
class SmartyType extends TranslatorAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('template_compilation', ChoiceType::class, [
                'choices' => [
                    'Never recompile template files' => 0,
                    'Recompile templates if the files have been updated' => 1,
                    'Force compilation' => 2,
                ],
                'required' => false,
                'label' => $this->trans('Template compilation', 'Admin.Advparameters.Feature'),
            ])
            ->add('cache', SwitchType::class, [
                'required' => false,
                'label' => $this->trans('Cache', 'Admin.Advparameters.Feature'),
                'help' => $this->trans('Should be enabled except for debugging.', 'Admin.Advparameters.Feature'),
            ])
            ->add('multi_front_optimization', SwitchType::class, [
                'required' => false,
                'label' => $this->trans('Multi-front optimizations', 'Admin.Advparameters.Feature'),
                'help' => $this->trans('Should be enabled if you want to avoid to store the smarty cache on NFS.', 'Admin.Advparameters.Help'),
                'row_attr' => [
                    'class' => 'smarty-cache-option',
                ],
            ])
            ->add('caching_type', ChoiceType::class, [
                'choices' => [
                    'File System' => 'filesystem',
                    'MySQL' => 'mysql',
                ],
                'required' => false,
                'label' => $this->trans('Caching type', 'Admin.Advparameters.Feature'),
                'row_attr' => [
                    'class' => 'smarty-cache-option',
                ],
            ])
            ->add('clear_cache', ChoiceType::class, [
                'choices' => [
                    'Never clear cache files' => 'never',
                    'Clear cache everytime something has been modified' => 'everytime',
                ],
                'required' => false,
                'label' => $this->trans('Clear cache', 'Admin.Advparameters.Feature'),
                'row_attr' => [
                    'class' => 'smarty-cache-option',
                ],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => 'Admin.Advparameters.Feature',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'performance_smarty_block';
    }
}
