
Trois grands types de design patterns :
- les design créationnels : la création d'objet (Factory, Builder, Prototype, Singleton)
- les design structuraux : relation entre les classes (Adapter, Composite, Decorator)
- les design comportementaux : gérer les états des objets

<?php
    // design pattern builder : adapté à la création d'instance nécessitant plusieurs étapes
    class Employee {
        private $team;
        private $salary;

        public function setTeam($team) {
            $this->team = $team;
        }

        public function setSalary($salary) {
            $this->salary = $salary;
        }
    }

    $employee = new Employee();
    $employee->setTeam(1);
    $employee->setSalary(1500);

    $employee = new Employee();
    $employee->setTeam(1);
    $employee->setSalary(1500);

    $employee = new Employee();
    $employee->setTeam(3);
    $employee->setSalary(2500);

    class EmployeeBuilder {
        private $employee;

        public function __construct()
        {
            $this->employee = new Employee();
        }

        public function putInDefaultTeamWithDefaultSalary() {
            $this->employee->setTeam(1);
            $this->employee->setSalary(1500);

            return $this;
        }

        public function defaultChief() {
            $employee = $this->putInDefaultTeamWithDefaultSalary();
            $this->doubleSalary();
            return $this;
        }

        public function doubleSalary() {
            $salary = $this->employee->getSalary();
            $salary = $salary * 2;
            $this->employee->setSalary($salary);
        }

        public function getEmployee() {
            return $this->employee;
        }
    }

    class EmployeeDirector {
        public function createDefaultEmployee() {
            $employee = (new EmployeeBuilder())
                ->putInDefaultTeamWithDefaultSalary()
                ->getEmployee();
            return $employee;
        }

        public function createDefaultChief() {
            $employee = (new EmployeeBuilder())
                ->defaultChief();
            return $employee;
        }
    }

    /*
     * en imaginant qu'on veut faire un peu comme symfony : s'assurer de ne pas
     * instancier plusieurs directors, sans utiliser un singleton */
     /*
    class Container {
        static private $employeeDirector;
        static public function getDirectorEmployee() {
            if (self::$employeeDirector == null) {
                self::$employeeDirector = new EmployeeDirector();
            }
            self::$employeeDirector;
        }
    }
    */

    $director = new EmployeeDirector();
    $defaultEmployee = $director->createDefaultEmployee();
    $chief = $director->createDefaultChief();

    /*
     * Adapter : éviter les dépendances entre les classes, grâce aux interfaces
     * Rendre compatible des classes incompatibles entre elles
     */
    class Class1 {
        public function doSomething(IClass2 $class2) {
            $this->method();
            $class2->test();
        }
        public function method() {}
    }

    interface IClass2 {
        public function test();
    }

    class Class2 implements IClass2 {
        public function test() {

        }
    }

    class Class3 implements IClass2 {
        public function test() {

        }
    }

    $class1 = new Class1();
    $class3 = new Class3();
    $class1->doSomething($class3);


/**
 *  Pattern strategy :
 *  mettre à disposition une liste d'algorithme et
 *  permettre d'appeler le bon  dynamiquement en fonction du contexte :
 * bon moyen pour détecter un strategy : plein de if, elseif...
 */

    class Recorder {
        private $typeRecorder;

        public function __construct(RecorderInterface $typeRecorder)
        {
            $this->typeRecorder = $typeRecorder;
        }

        public function record(array $player) {
            $this->typeRecorder->save($player);
        }
    }

    interface RecorderInterface {
        public function save(array $player);
    }

    class DBRecorder implements RecorderInterface {
        public function save(array $player) {
            /*
            $pdo = new PDO();
            $pdo->prepare();
            */
        }

        public function closeDB() {

        }

    }

    class FileRecorder implements RecorderInterface {
        public function save(array $player) {
            $file = fopen("txt.txt");
            fwrite($file, $player[0].";".$player[1]);
            fclose($file);
        }

        public function closeFile() {

        }
    }

    class ApiRecorder implements RecorderInterface {
        public function save(array $player) {
            // connexion API, envoi, etc.

        }
    }

    class NoSQLRecorder implements RecorderInterface {
        public function save(array $player) {
            // connexion bdd no sql

        }
    }

    $player = ['fab', '33', 'Lille'];
    $typeRecorder = new DBRecorder();
    $recorder = new Recorder($typeRecorder);
    $recorder->record($player);

?>


