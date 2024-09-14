<?php 

namespace Evolutive\CommandeCli\Generator;

class PresenterMethodsGenerator
{
    /**
     * Generates methods for the specified presenter class.
     *
     * @param string $name The name of the presenter class
     * @param string $namespace The namespace for the presenter class
     * @return string The generated presenter class with methods
     */
    public function getMethods(string $name, string $namespace): string
    {
        return "<?php\n\nnamespace $namespace\\Presenter;\n\n" .
            "class {$name}Presenter\n{\n" .

            "    /**\n" .
            "     * Presents the provided data for output.\n" .
            "     *\n" .
            "     * @param mixed \$data The data to present\n" .
            "     * @return array The formatted presentation of the data\n" .
            "     */\n" .
            "    public function present(\$data): array\n    {\n" .
            "        // Logic to present data\n" .
            "        // Example: Format data for a view\n" .
            "        return ['presentedData' => \$data]; // Modify as needed\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Prepares data for specific formatting or rendering.\n" .
            "     *\n" .
            "     * @param mixed \$data The data to prepare\n" .
            "     * @return array The prepared data\n" .
            "     */\n" .
            "    public function prepareForRendering(\$data): array\n    {\n" .
            "        // Preparation logic goes here\n" .
            "        return ['preparedData' => \$data]; // Example preparation\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Filters data based on specified criteria.\n" .
            "     *\n" .
            "     * @param array \$data The data to filter\n" .
            "     * @param callable \$criteria The criteria for filtering\n" .
            "     * @return array The filtered data\n" .
            "     */\n" .
            "    public function filterData(array \$data, callable \$criteria): array\n    {\n" .
            "        // Filtering logic goes here\n" .
            "        return array_filter(\$data, \$criteria); // Example filtering\n" .
            "    }\n" .

            "}\n";
    }
}
