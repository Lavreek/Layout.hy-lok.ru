<?php

namespace App\Controller;

use App\Entity\VisitorsInfo;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class VisitorController
{
    function generateVisitor(ManagerRegistry $registry, $serverData, $cookieData, $requestData) {
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
//        $sql = "
//		    INSERT INTO `visitors_info`
//		    (`vid`,`ip_user_agent_hash`, `user_agent`, `ip`,`addDate`,`lastVisit`)
//		    VALUES
//		    (
//		        '',
//		        $ip_user_agent_hash,
//		        $user_agent,
//		        $ip,
//		        $current_timestamp,
//		        $current_timestamp
//	        )";
//
//        $insert = $modx->exec($sql);
//
//        if (!$insert) {
//            $modx->log(1, "Не удалось добавить нового юзера в таблицу<br>$sql");
//            return false;
//        }
//
//        $dbId = $modx->lastInsertId();
//
//        //добавляем в базу его VID
//        $vid = users_id_generator_generateUniqueNumber($dbId);
//        $vid_quoted = $modx->quote($vid, PDO::PARAM_STR);
//        $dbId = $modx->quote($dbId, PDO::PARAM_INT);
//
//        $modx->exec("UPDATE `visitors_info` SET `vid` = $vid_quoted WHERE `id` = $dbId");
//
//        return $vid;
    }

    public function searchVisitor(ManagerRegistry $registry, $cookieData) {
        $visitor = $registry->getRepository(VisitorsInfo::class)->findOneBy(['_ym_uid' => $cookieData['_ym_uid'], 'fingerprint' => $cookieData['FINGERPRINT_ID']]);

        if ($visitor) {
            return $visitor->getVid();
        }

        return;
    }

    private function generateUniqueNumber($id)
    {
        $ns = 26;
        $r[] = 0;
        $edge = $id;
        while ( $edge > 0 ){
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
