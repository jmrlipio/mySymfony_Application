<?php

namespace Jone\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jone\BlogBundle\Entity\Enquiry;
use Jone\BlogBundle\Form\EnquiryType;

class ContactusController extends Controller
{
    public function indexAction()
    {
        $enquiry = new Enquiry();
	    $form = $this->createForm(new EnquiryType(), $enquiry);
	
	    $request = $this->getRequest();
			    if ($request->getMethod() == 'POST') {
			        $form->bind($request); 
			
			    if ($form->isValid()) {
		
		         $message = \Swift_Message::newInstance()
		            ->setSubject('Contact enquiry from symblog')
		            ->setFrom('enquiries@symblog.co.uk')
		            ->setTo($this->container->getParameter('Jone_blog.emails.contact_email'))
		            ->setBody($this->renderView('JoneBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
		        $this->get('mailer')->send($message);
		
				$this->get('session')->getFlashBag()->add(
					'blogger-notice',
					'Your contact enquiry was successfully sent. Thank you!'
					);
		        // Redirect - This is important to prevent users re-posting
		        // the form if they refresh the page
		        return $this->render('JoneBlogBundle:Contactus:contactus.html.twig',array('form' => $form->createView()));
		    }
	    }	
		return $this->render('JoneBlogBundle:Contactus:contactus.html.twig',array('form' => $form->createView()));

        // render a PHP template instead
        // return $this->render(
        //     'AcmeHelloBundle:Hello:index.html.php',
        //     array('name' => $name)
        // );
    }
}
?>
