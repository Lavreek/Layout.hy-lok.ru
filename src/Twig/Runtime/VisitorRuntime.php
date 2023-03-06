<?php

namespace App\Twig\Runtime;

use App\Entity\VisitorsInfo;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Twig\Extension\RuntimeExtensionInterface;

class VisitorRuntime extends AbstractController implements RuntimeExtensionInterface
{
    private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        // Inject dependencies if needed
        $this->registry = $registry;
    }


    public function getVid($cookies)
    {
        $registry = $this->registry;
        $manager = $registry->getManager();

        if (!empty($cookies->get('_ym_uid')) and !empty($cookies->get('FINGERPRINT_ID'))) {
            $visitor = $registry->getRepository(VisitorsInfo::class)->findOneBy(
                ['_ym_uid' => $cookies->get('_ym_uid'), 'fingerprint' => $cookies->get('FINGERPRINT_ID')]
            );

            if ($visitor) {
                $visitor->setVisitedOn(new \DateTime(date("Y-m-d H:i:s")));
                $manager->persist($visitor);
                $manager->flush();

                return $visitor->getVid();
            }

            return 'mail';
        }
    }
}
