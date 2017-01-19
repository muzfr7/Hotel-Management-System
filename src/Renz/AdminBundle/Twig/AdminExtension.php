<?php 

namespace Renz\AdminBundle\Twig;

class AdminExtension extends \Twig_Extension
{
	public function getFilters()
	{
		return array(
			new \Twig_SimpleFilter('between', array($this, 'betweenFilter')),
		);
	}

	public function betweenFilter($now, $datefrom="", $dateto="")
	{
		if( ($now <= $dateto) AND ($now >= $datefrom) ){
			return true;
		}else{
			return false;
		}
	}

	public function getName()
	{
		return 'admin_extension';
	}
}