# Installation
* Clone this repository
* Go to project's root directory
* Run
    * `composer install`
* That's it! You can check sample code in `index.php`, but all code is placed in `./test/`

# Usage
* Go to `index.php` or just run `php vendor/bin/codecept run unit`

# Module system
* Create your own class which inherits `\Main\Search\Model\BaseSearch::class`
* Implement your very own `search` method
* **Optional** : create your own class which inherits `\Main\Search\Entity\BaseResult`
* To make your results appear in `ResultCollection` be sure you have returned `\Main\Search\Entity\BaseResult` with property `line` which is not `false`  