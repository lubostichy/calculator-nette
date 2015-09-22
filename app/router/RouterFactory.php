<?php

namespace App;

use Nette\Application\Routers\SimpleRouter;

/**
 * Router pre aplikaciu kalkulacka.
 * @package App
 */
class RouterFactory
{

	/**
         * Vracia definovany router.
	 * @return SimpleRouter router
	 */
	public static function createRouter()
	{
            // nastavi predvolene routovanie na presenter
            return new SimpleRouter('Calculator:default');
	}

}
