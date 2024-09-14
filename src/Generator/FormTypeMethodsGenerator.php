<?php 

namespace Evolutive\CommandeCli\Generator;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormTypeMethodsGenerator
{
    /**
     * Generates the methods for the specified form type.
     *
     * @param string $name The name of the form type
     * @param string $namespace The namespace for the form type
     * @return string The generated form type class with methods
     */
    public function getMethods(string $name, string $namespace): string
    {
        return "<?php\n\nnamespace $namespace\\Form\\FormType;\n\n" .
            "use Symfony\\Component\\Form\\AbstractType;\n" .
            "use Symfony\\Component\\Form\\FormBuilderInterface;\n" .
            "use Symfony\\Component\\OptionsResolver\\OptionsResolver;\n\n" .

            "class {$name}FormType extends AbstractType\n{\n" .

            "    /**\n" .
            "     * Builds the form with specified fields.\n" .
            "     *\n" .
            "     * @param FormBuilderInterface \$builder The form builder\n" .
            "     * @param array \$options The options for the form\n" .
            "     */\n" .
            "    public function buildForm(FormBuilderInterface \$builder, array \$options)\n" .
            "    {\n" .
            "        // Example: Add form fields\n" .
            "        \$builder\n" .
            "            ->add('field1', TextType::class, ['label' => 'Field 1'])\n" .
            "            ->add('field2', TextareaType::class, ['label' => 'Field 2']);\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Configures the options for this form type.\n" .
            "     *\n" .
            "     * @param OptionsResolver \$resolver The resolver for the options\n" .
            "     */\n" .
            "    public function configureOptions(OptionsResolver \$resolver)\n" .
            "    {\n" .
            "        \$resolver->setDefaults([\n" .
            "            'data_class' => {$namespace}\\Entity\\{$name}::class,\n" .
            "        ]);\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Returns the block prefix used to refer to this type.\n" .
            "     *\n" .
            "     * @return string The block prefix\n" .
            "     */\n" .
            "    public function getBlockPrefix(): string\n" .
            "    {\n" .
            "        return '{$name}_form';\n" .
            "    }\n" .

            "}\n";
    }
}
