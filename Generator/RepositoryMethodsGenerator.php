<?php 

namespace Evo\CommandeCli\Generator;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class RepositoryMethodsGenerator
{
    /**
     * Generates methods for the specified repository class.
     *
     * @param string $name The name of the repository class
     * @param string $namespace The namespace for the repository class
     * @return string The generated repository class with methods
     */
    public function getMethods(string $name, string $namespace): string
    {
        return "<?php\n\nnamespace $namespace\\Repository;\n\n" .
            "use Doctrine\\ORM\\EntityRepository;\n" .
            "use Doctrine\\ORM\\QueryBuilder;\n\n" .

            "class {$name}Repository extends EntityRepository\n{\n" .

            "    /**\n" .
            "     * Finds all entities in the repository.\n" .
            "     *\n" .
            "     * @return array The array of entities\n" .
            "     */\n" .
            "    public function findAllEntities(): array\n    {\n" .
            "        return \$this->findAll(); // Uses Doctrine's findAll method\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Finds an entity by its ID.\n" .
            "     *\n" .
            "     * @param int \$id The ID of the entity\n" .
            "     * @return mixed|null The entity or null if not found\n" .
            "     */\n" .
            "    public function findEntityById(int \$id)\n    {\n" .
            "        return \$this->find(\$id); // Uses Doctrine's find method\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Custom method to find entities by a specific field.\n" .
            "     *\n" .
            "     * @param string \$field The field to filter by\n" .
            "     * @param mixed \$value The value of the field\n" .
            "     * @return array The array of entities matching the criteria\n" .
            "     */\n" .
            "    public function findByField(string \$field, \$value): array\n    {\n" .
            "        return \$this->findBy([\$field => \$value]); // Uses Doctrine's findBy method\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Creates a QueryBuilder for custom queries.\n" .
            "     *\n" .
            "     * @return QueryBuilder The QueryBuilder instance\n" .
            "     */\n" .
            "    public function createCustomQueryBuilder(): QueryBuilder\n    {\n" .
            "        return \$this->createQueryBuilder('e'); // Example alias 'e'\n" .
            "    }\n" .

            "}\n";
    }
}
