<?php

namespace Pim\Bundle\CatalogBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Override the imported product data transformer if the parameter has been set
 *
 * @author    Gildas Quemener <gildas@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class SetImportedProductDataTransformerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('pim_catalog.form.type.product')) {
            return;
        }

        $productType = $container->getDefinition('pim_catalog.form.type.product');
        $transformer = $container->getParameter('pim_catalog.imported_product_data_transformer');

        if ($transformer) {
            $productType->replaceArgument(3, new Reference($transformer));
        }
    }
}
