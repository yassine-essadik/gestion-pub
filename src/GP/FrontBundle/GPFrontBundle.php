<?php

namespace GP\FrontBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GPFrontBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
