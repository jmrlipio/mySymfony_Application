<?php

namespace Jone\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactusController extends Controller
{
    public function indexAction()
    {
        return $this->render('JoneBlogBundle:Contactus:contactus.html.twig');
      

        // render a PHP template instead
        // return $this->render(
        //     'AcmeHelloBundle:Hello:index.html.php',
        //     array('name' => $name)
        // );
    }
}
?>
