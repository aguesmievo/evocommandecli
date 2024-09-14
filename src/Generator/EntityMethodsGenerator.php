<?php 

namespace Evolutive\CommandeCli\Generator;

class EntityMethodsGenerator
{
    public function getMethods(string $name, ?string $fields, string $namespace): string
    {
        $fieldsArray = explode(',', $fields);
        $properties = '';
        $gettersSetters = '';

        foreach ($fieldsArray as $field) {
            [$fieldName, $fieldType] = explode(':', $field);
            $fieldNameCamel = ucfirst($fieldName);
            $properties .= "    private \$$fieldName;\n";
            $gettersSetters .= "    public function get{$fieldNameCamel}() { return \$this->$fieldName; }\n\n";
            $gettersSetters .= "    public function set{$fieldNameCamel}($fieldType \$$fieldName) { \$this->$fieldName = \$$fieldName; }\n\n";
        }

        return "<?php\n\nnamespace $namespace\\Entity;\n\nclass $name\n{\n$properties\n$gettersSetters}\n";
    }
}
