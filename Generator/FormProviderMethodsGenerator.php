<?php

namespace Evo\CommandeCli\Generator;

class FormProviderMethodsGenerator
{
    /**
     * Generates the methods for the specified form provider.
     *
     * @param string $name The name of the form provider
     * @param string $namespace The namespace for the form provider
     * @return string The generated form provider class with methods
     */
    public function getMethods(string $name, string $namespace): string
    {
        return "<?php\n\nnamespace $namespace\\Form\\FormProvider;\n\n" .
            "class {$name}FormProvider\n{\n" .

            "    /**\n" .
            "     * Provides data for the form\n" .
            "     *\n" .
            "     * @return array The data to populate the form\n" .
            "     */\n" .
            "    public function provide(): array\n" .
            "    {\n" .
            "        // Logic for providing default form data\n" .
            "        return [\n" .
            "            'field1' => 'default value',\n" .
            "            'field2' => '',\n" .
            "        ];\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Provides the initial data for the form based on an entity\n" .
            "     *\n" .
            "     * @param object \$entity The entity to populate the form with\n" .
            "     * @return array The data to populate the form\n" .
            "     */\n" .
            "    public function provideFromEntity(object \$entity): array\n" .
            "    {\n" .
            "        // Logic to extract data from the entity\n" .
            "        return [\n" .
            "            'field1' => \$entity->getField1(),\n" .
            "            'field2' => \$entity->getField2(),\n" .
            "        ];\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Provides validation data or rules for the form\n" .
            "     *\n" .
            "     * @return array The validation rules\n" .
            "     */\n" .
            "    public function provideValidationRules(): array\n" .
            "    {\n" .
            "        // Example validation rules\n" .
            "        return [\n" .
            "            'field1' => ['required' => true, 'type' => 'string'],\n" .
            "            'field2' => ['required' => false, 'type' => 'string'],\n" .
            "        ];\n" .
            "    }\n" .

            "}\n";
    }
}
