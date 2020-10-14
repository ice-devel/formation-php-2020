<?php
/*
 * Les namespaces : espaces de nom
 * Les namespaces servent à ranger nos classes dans des "répertoires"
 * Ainsi on peut avoir plusieurs classes qui ont le même nom
 * dans un même projet,
 * à condition qu'elles ne soient pas dans le même namespace
 */

// on définit le namespace d'une classe juste au dessus de la-dite classe
namespace Fabian\Game;
class Player {
    private $name;
}

namespace Fabian\Work;
class Player {
    private $name;
}

namespace Fabian\Pleasure;
class Player {
    private $name;
}










