<?php

namespace App\Controller;

use App\Entity\UserRequests;
use App\Entity\UserVisit;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_root', methods: ['GET'])]
    public function index(): Response
    {
        $catalogRoot = $_SERVER['DOCUMENT_ROOT'] . "/assets/catalogs";
        $directories = array_diff(scandir($catalogRoot), ['.', '..']);

        $catalogArray = [];
        foreach ($directories as $directory) {
            $files = array_diff(scandir($catalogRoot . "/" . $directory), ['.', '..']);

            foreach ($files as $file) {
                $filename = trim(str_replace(['_', '-', '.pdf'], ' ', $file));
                array_push($catalogArray, ['name' => $filename, 'path' => $directory . "/" . $file]);
            }
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'certificates' => 4,
            'catalogs' => $catalogArray,
        ]);
    }

    #[Route('/visit', name: 'app_visit', methods: ['POST'])]
    public function visit(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        $serverData = $request->server->all();
        $requestData = $request->request->all();
        $cookieData = $request->cookies->all();

        if (isset($cookieData['_ym_uid'])) {
            $visit = $doctrine->getRepository(UserVisit::class);

            $client = $visit->findOneBy(['u_ym_uid' => $cookieData['_ym_uid']]);

            if (!$client) {
                $EntityManager = $doctrine->getManager();
                $UserVisit = new UserVisit();
                $UserVisit->setUIp($serverData['REMOTE_ADDR']);
                $UserVisit->setSitePage('root');

                $geo = "";
                if (isset($serverData['GEOIP_COUNTRY_NAME'])) {
                    $geo .= $serverData['GEOIP_COUNTRY_NAME'] . " / ";
                }

                if (isset($serverData['GEOIP_REGION'])) {
                    $geo .= $serverData['GEOIP_REGION'] . " / ";
                }

                if (isset($serverData['GEOIP_CITY'])) {
                    $geo .= $serverData['GEOIP_CITY'] . " / ";
                }
                $UserVisit->setUGeo($geo);

                $UserVisit->setUWidth($requestData['Width']);
                $UserVisit->setCreatedAt(new \DateTime());
                $UserVisit->setUYmUid($cookieData['_ym_uid']);
                $UserVisit->setFingerprintId($requestData['FINGERPRINT_ID']);
                $EntityManager->persist($UserVisit);
                $EntityManager->flush();

                return new JsonResponse('Done!');
            }
        }
        return new JsonResponse('falied :(');
    }

    #[Route('/', name: 'app_create_request', methods: ['POST'])]
    public function indexRequest(
        MailerInterface $mailer,
        Request $request,
        ManagerRegistry $doctrine,
        ValidatorInterface $validator
    ): JsonResponse
    {
        $formData = $request->request->all();
        $serverData = $request->server->all();
        $cookieData = $request->cookies->all();

        if (isset($formData['emailInput'], $formData['commentInput'], $cookieData['width'])) {
            $EntityManager = $doctrine->getManager();
            $UserRequest = new UserRequests();

            $formData['emailInput'] = addslashes($formData['emailInput']);
            $formData['commentInput'] = addslashes($formData['commentInput']);

            $UserRequest->setUEmail($formData['emailInput']);
            $UserRequest->setUComment($formData['commentInput']);
            $UserRequest->setUWidth($cookieData['width']);
            $UserRequest->setCreatedAt(new \DateTime());

            if (isset($serverData['REMOTE_ADDR'])) {
                $UserRequest->setUIp($serverData['REMOTE_ADDR']);
            } else {
                $UserRequest->setUIp("");
            }

            $geo = "";
            if (isset($serverData['GEOIP_COUNTRY_NAME'])) {
                $geo .= $serverData['GEOIP_COUNTRY_NAME'] . " / ";
            }

            if (isset($serverData['GEOIP_REGION'])) {
                $geo .= $serverData['GEOIP_REGION'] . " / ";
            }

            if (isset($serverData['GEOIP_CITY'])) {
                $geo .= $serverData['GEOIP_CITY'] . " / ";
            }
            $UserRequest->setUGeo($geo);

            if (isset($cookieData['_ym_uid'])) {
                $UserRequest->setUYmUid($cookieData['_ym_uid']);
            } else {
                $UserRequest->setUYmUid("");
            }

            if (isset($cookieData['FINGERPRINT_ID'])) {
                $UserRequest->setFingerprintId($cookieData['FINGERPRINT_ID']);
            } else {
                $UserRequest->setFingerprintId("");
            }

            $UserRequest->setFingerprintId($cookieData['FINGERPRINT_ID']);


            $errors = $validator->validate($UserRequest);

            if (count($errors) < 1) {
                $EntityManager->persist($UserRequest);
                $EntityManager->flush();

                if ($geo == "") {
                    $geo = "неизвестно";
                }

                $email = (new TemplatedEmail())
                    ->from('mail@hy-lok.ru')
                    ->to('alex@fluid-line.ru')
                    ->subject('Новое письмо от сайта hy-lok!')
                    ->htmlTemplate('email/index.html.twig')
                    ->context([
                        'user_email' => $formData['emailInput'],
                        'comment' => $formData['commentInput'],
                        'geo' => $geo
                    ])
                ;

                $mailer->send($email);

                return new JsonResponse(['message' => 'Ваша заявка была успешно принята.']);
            }
        }

        return new JsonResponse(['message' => 'К сожалению, ваша заявка не может быть обработана.']);
    }
}
