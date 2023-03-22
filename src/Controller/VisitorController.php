<?php

namespace App\Controller;

use App\Entity\VisitorsInfo;
use Doctrine\Persistence\ManagerRegistry;

class VisitorController
{
    public function generateVisitor(ManagerRegistry $registry, $serverData, $cookieData)
    {
        $time = new \DateTime(date("Y-m-d H:i:s"));

        $manager = $registry->getManager();

        $visitor = new VisitorsInfo();
        $visitor->setVid($this->generateUniqueNumber(time()));
        $visitor->setUserAgent($serverData['HTTP_USER_AGENT']);
        $visitor->setIp($serverData['REMOTE_ADDR']);
        $visitor->setFingerprint($cookieData['FINGERPRINT_ID']);
        $visitor->setYmUid($cookieData['_ym_uid']);
        $visitor->setCreatedOn($time);
        $visitor->setVisitedOn($time);

        $manager->persist($visitor);
        $manager->flush();

        return $visitor->getVid();
    }

    public function searchVisitor(ManagerRegistry $registry, $cookieData)
    {
        $visitor = $registry->getRepository(VisitorsInfo::class)->findOneBy(['_ym_uid' => $cookieData['_ym_uid'], 'fingerprint' => $cookieData['FINGERPRINT_ID']]);

        if ($visitor) {
            return $visitor->getVid();
        }

        return null;
    }

    private function generateUniqueNumber($id)
    {
        $ns = 26;
        $r[] = 0;
        $edge = $id;

        while ($edge > 0) {
            $n = log($edge, $ns);
            $s = floor ($n);
            if($edge === $id){
                $n_keys = $s + 1;
                $r = array_pad($r, $n_keys, 0);
            }
            $r[$s]++;
            $edge = $edge - pow($ns, $s);
        }

        $string = '';
        $abc = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");

        foreach (array_reverse($r) as $value){
            $string .= $abc[$value];
        }

        return $string;
    }
}
