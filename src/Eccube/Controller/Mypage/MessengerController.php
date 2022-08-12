<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eccube\Controller\Mypage;

use Customize\Entity\CustomerSiteInfo;
use Customize\Entity\CustomerChatInfo;
use Customize\Repository\CustomerChatConversationRepository;
use Customize\Repository\CustomerChatInfoRepository;
use Customize\Repository\CustomerSiteInfoRepository;
use Eccube\Controller\AbstractController;
use Eccube\Entity\BaseInfo;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Eccube\Repository\BaseInfoRepository;
use Eccube\Repository\CustomerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class MessengerController extends AbstractController
{
    /**
     * @var limit_storage
     */
    protected  $limit_storage = 5368709120;
    /**
     * @var page_default
     */
    protected $page_default = 0;
    /**
     * @var BaseInfo
     */
    protected $BaseInfo;

    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var CustomerSiteInfoRepository
     */
    protected $customerSiteInfoRepository;

    /**
     * @var CustomerChatInfoRepository
     */
    protected $customerChatInfoRepository;

    /**
     * @var CustomerChatConversationRepository
     */
    protected $customerChatConversationRepository;

    public function __construct(
        BaseInfoRepository $baseInfoRepository,
        CustomerRepository $customerRepository,
        CustomerSiteInfoRepository $customerSiteInfoRepository,
        CustomerChatInfoRepository $customerChatInfoRepository,
        CustomerChatConversationRepository $customerChatConversationRepository)
    {
        $this->BaseInfo = $baseInfoRepository->get();
        $this->customerRepository = $customerRepository;
        $this->customerSiteInfoRepository = $customerSiteInfoRepository;
        $this->customerChatInfoRepository = $customerChatInfoRepository;
        $this->customerChatConversationRepository = $customerChatConversationRepository;
    }

    /**
     * お届け先一覧画面.
     *
     * @Route("/mypage/messenger", name="mypage_messenger")
     * @Template("Mypage/messenger.twig")
     */
    public function index(Request $request)
    {
        $Customer = $this->getUser();
        return [
            'Customer' => $Customer,
        ];
    }
    /**
     * お届け先一覧画面.
     *
     * @Route("/mypage/messenger/downloadFile", name="mypage_messenger_downloadFile")
     */
    public function downloadFile(Request $request)
    {
        $id_mess = $request->get('id_mess');
        $info_mess = $this->customerChatConversationRepository->findOneBy(['id' => $id_mess,'delete_at' => null]);
        if ($info_mess){
            $src = '/html/upload/strage/'.$this->getUser()->getParentId().'/chat/'. $info_mess->getChatInfoId() .'/'.$info_mess->getFileName();
            $data = [
                'success' => true,
                'src' => $src,
                'file_name' => $info_mess->getFileName(),
            ];
            return new JsonResponse($data);
        }
        $data = [
            'success' => false,
            'html' => '<p class="error-msg">ファイルが存在しません。</p>',
        ];
        return new JsonResponse($data);
    }
    /**
     * お届け先一覧画面.
     *
     * @Route("/mypage/messenger/previewFile", name="mypage_messenger_previewFile")
     */
    public function previewFile(Request $request)
    {
        $id_mess = $request->get('id_mess');
        $info_mess = $this->customerChatConversationRepository->findOneBy(['id' => $id_mess,'delete_at' => null]);
        if ($info_mess){
            $src = '/html/upload/strage/'.$this->getUser()->getParentId().'/chat/'. $info_mess->getChatInfoId() .'/'.$info_mess->getFileName();
            $html = '<img src="'.$src.'" >';
            $data = [
                'success' => true,
                'html' => $html,
            ];
            return new JsonResponse($data);
        }
        $data = [
            'success' => false,
            'html' => '<p class="error-msg">ファイルが存在しません。</p>',
        ];
        return new JsonResponse($data);
    }
    /**
     * お届け先一覧画面.
     *
     * @Route("/mypage/messenger/deleteFile", name="mypage_messenger_deleteFile")
     */
    public function deleteFile(Request $request)
    {
        $id_mess = $request->get('id_mess');
        $info_mess = $this->customerChatConversationRepository->findOneBy(['id' => $id_mess]);
        if ($info_mess){
            $info_mess->setDeleteAt(new \DateTime());
            $this->entityManager->persist($info_mess);
            $this->entityManager->flush();
            $data = [
                'success' => true,
                'html' => null,
            ];
            return new JsonResponse($data);
        }
        $data = [
            'success' => false,
            'html' => null,
        ];
        return new JsonResponse($data);
    }
    /**
     * お届け先一覧画面.
     *
     * @Route("/mypage/messenger/getinfo", name="mypage_messenger_getinfo")
     */
    public function getInfo(Request $request)
    {
        switch ($request->get('data')) {
            case '0':
                $parent_id = $this->getUser()->getParentId();
                $customer = $this->customerSiteInfoRepository
                    ->createQueryBuilder('cs')
                    ->select('cs.id','cs.site_name')
                    ->where('cs.customer_id = :parent_id')
                    ->setParameter('parent_id', $parent_id)
                    ->getQuery()
                    ->getArrayResult();
                return new JsonResponse(['site_info' => $customer]);
            case '1':
                $own_id = $this->getUser()->getId();
                $parent_id = $this->getUser()->getParentId();
                $customer = $this->customerRepository
                    ->getQueryBuilderBySearchData([])
                    ->select('c.id','c.name01','c.name02')
                    ->andWhere('c.parent_id = :parent_id OR c.id = :parent_id')
                    ->setParameter('parent_id', $parent_id)
                    ->andWhere('c.id != :own_id')
                    ->setParameter('own_id', $own_id)
                    ->andWhere('c.delete_at is null')
                    ->getQuery()
                    ->getArrayResult();
                return new JsonResponse(['customer' => $customer]);

        }
    }
    function setStatusListen($id_room,$status,$delay = 0){
        $cache_file_name = $this->getParameter('eccube_theme_app_dir').'/user_data/chat_cache_'.$id_room.'.json';
        $value = [
            'flag' => $status
        ];
        sleep($delay);
        file_put_contents($cache_file_name,json_encode($value));
    }
    /**
     * お届け先一覧画面.
     *
     * @Route("/mypage/messenger/getlist", name="mypage_messenger_getListMessenger")
     */
    public function getList(Request $request)
    {
        $id_sent = $this->getUser()->getId();
        $id_recei = $request->get('id');
        $type = (int) $request->get('type');
        $id_room = $request->get('id_room');
        $id_page = (int) $request->get('id_page');

        $cache_file_name = $this->getParameter('eccube_theme_app_dir').'/user_data/chat_cache_'.$id_room.'.json';
        $cache_page_chat = $this->getParameter('eccube_theme_app_dir').'/user_data/page_cache_'.$id_sent.'.json';
        if ($id_room){// lísten
            if(!file_exists($cache_file_name)){
                file_put_contents($cache_file_name,'');
            }
            if(!file_exists($cache_page_chat)){
                file_put_contents($cache_page_chat,json_encode(['page'=>$id_page]));
            }

            $get_p = file_get_contents($cache_page_chat);
            $old_page = json_decode($get_p);

            $get_ctn = file_get_contents($cache_file_name);
            $file = json_decode($get_ctn);
            $html = null;
            if(is_null($file)){
                $this->setStatusListen($id_room,false,0);
            }else{
                if($file->flag === true || $old_page->page != $id_page){
                    $html = $this->renderBubble($type,$id_recei,$id_sent,$id_room,$id_page);
                    file_put_contents($cache_page_chat,json_encode(['page'=>$id_page]));
                    $this->setStatusListen($id_room,false,1);
                }
            }
        }else{// init
            // check exist in customer_chat_ìno
            file_put_contents($cache_page_chat,json_encode(['page'=>0]));
            $html = $this->renderBubble($type,$id_recei,$id_sent,$id_room,$id_page);
        }

        $data = [
            'success' => true,
            'html' => $html,
            'id_room' => $id_room
        ];
        return new JsonResponse($data);
    }
    function renderBubble($type,$id_recei,$id_sent,&$id_room,$id_page){
        if (!$id_room){
            $chat_info = $this->checkTypeInfo($type,$id_recei,$id_sent);
            if (!$chat_info){
                // none exist
                $chat_info = $this->customerChatInfoRepository->newChat();
                if ($type == 0){
                    $chat_info->setTargetId($id_recei);
                }else{
                    $chat_info->setTargetId($id_sent.'/'.$id_recei);
                }
                $chat_info->setTargetClass($type);
                $chat_info->setCreateDate(new \DateTime());

                $this->entityManager->persist($chat_info);
                $this->entityManager->flush();
                $id_room = $chat_info->getId();
            }else{
                $id_room = $chat_info[0]['id'];
            }
        }
        $limit = 30;
        if ($id_page > 0){
            $id_page = $id_page * $limit;
        }
        $Conversation = $this->customerChatConversationRepository->createQueryBuilder('c')
            ->andWhere('c.chat_info_id = :room_id')
            ->setParameter('room_id', $id_room)
            ->andWhere('c.delete_at is null OR c.chat_class = :chat_class')
            ->setParameter('chat_class', 0)
            ->setMaxResults($limit)
            ->setFirstResult($id_page)
            ->orderBy('c.id', 'DESC');
        $list_mess = $Conversation->getQuery()->getResult();
        $list_mess = array_reverse($list_mess);

        return $this->renderView('Mypage/bubble_message.twig',['chat' => $list_mess,'author' => $id_sent]);
    }

    /**
     * お届け先一覧画面.
     *
     * @Route("/mypage/messenger/send", name="mypage_messenger_send")
     */
    public function send(Request $request)
    {
        $mess = $request->get('mess');
        $id_recei = $request->get('recei');
        $id_sent = $this->getUser()->getId();
        $type = $request->get('type');
        $id_room = $request->get('id_room');
        $register_name = $this->getUser()->getName01().' '.$this->getUser()->getName02();
        $chat_info = $this->checkTypeInfo($type,$id_recei,$id_sent);
        if (count($chat_info) > 0){
            $ChatInfo = $chat_info[0];
        }else{
            // none exist
            $Chat = $this->customerChatInfoRepository->newChat();
            if ($type == 0){
                $Chat->setTargetId($id_recei);
            }else{
                $Chat->setTargetId($id_sent.'/'.$id_recei);
            }
            $Chat->setTargetClass($type);
            $Chat->setCreateDate(new \DateTime());

            $this->entityManager->persist($Chat);
            $this->entityManager->flush();
            $ChatInfo = $Chat;
        }

        // create conversation
        $file = $request->files->get('file');
        if ($file){
            $user_storage = $this->getUser()->getStorageLimit();
            $size = $file->getSize();// Byte
            if ($user_storage > 0 ){
                $size = $size + $user_storage;
                if ($size > $this->limit_storage){
                    $data['success'] = false;
                    $data['message'] = 'ファイルの総保存サイズが規定のサイズ（５GB）を超える為、ファイルをアップロードできません。<br> 不要なファイルを削除して、空き容量を増やしてから再度アップロードして下さい。';
                    return new JsonResponse($data);
                }
            }
            $Customer = $this->customerRepository->findOneBy(['id' => $this->getUser()->getId()]);
            $Customer->setStorageLimit($size);
            $this->entityManager->persist($Customer);

            $fileName = md5(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->move(
                'html/upload/strage/'.$this->getUser()->getParentId().'/chat/'.$ChatInfo['id'],
                $fileName
            );

            $Conversation_fie = $this->customerChatConversationRepository->newConversation();
            $Conversation_fie->setChatInfo($ChatInfo);
            $Conversation_fie->setRegisterId($id_sent);
            $Conversation_fie->setRegisterName($register_name);
            $Conversation_fie->setChatClass(0);
            $Conversation_fie->setFileName($fileName);
            $Conversation_fie->setCreateDate(new \DateTime());
            $this->entityManager->persist($Conversation_fie);
        }
        if ($mess !== ''){
            $Conversation_txt = $this->customerChatConversationRepository->newConversation();
            $Conversation_txt->setChatInfo($ChatInfo);
            $Conversation_txt->setRegisterId($id_sent);
            $Conversation_txt->setRegisterName($register_name);
            $Conversation_txt->setChatClass(1);
            $Conversation_txt->setChatString($mess);
            $Conversation_txt->setCreateDate(new \DateTime());
            $this->entityManager->persist($Conversation_txt);
        }

        $this->entityManager->flush();

        $this->setStatusListen($id_room,true);
        $data = [
            'success' => true,
        ];
        return new JsonResponse($data);
    }

    /**
     * お届け先一覧画面.
     *
     * @Route("/mypage/messenger/received", name="mypage_messenger_received")
     */
    public function received(Request $request)
    {
        $id_sent = $request->get('sent');
        $id_room = $request->get('id_room');
        if (!$id_room){
            $data = [
                'success' => false,
                'message' => 'new Room'
            ];
            return new JsonResponse($data);
        }
        $date = date('Y-m-d H:i:s');
        $Conversation = $this->customerChatConversationRepository->createQueryBuilder('c')
                        ->andWhere('c.chat_info_id = :id_room')
                        ->setParameter('id_room', $id_room)
                        ->andWhere('c.register_id = :id_sent')
                        ->setParameter('id_sent', $id_sent)
                        ->andWhere('c.create_date >= :create_date_start')
                        ->setParameter('create_date_start', $date)
                        ->orderBy('c.create_date', 'DESC');
        $list_mess = $Conversation->getQuery()->getResult();
        $data = [
            'success' => true,
        ];
        return new JsonResponse($data);
    }
    /**
     * helper.
     *
     */
    public function checkTypeInfo($type,$id_recei,$id_sent)
    {
        $target_id = null;
        $query = $this->customerChatInfoRepository->createQueryBuilder('c')
            ->andWhere('c.target_class = :target_class')
            ->setParameter('target_class', $type);
        if ($type == 0){
            $target_id = $id_recei;
            $query = $query->andWhere('c.target_id = :target_id')->setParameter('target_id', $target_id);
        }else{
            $target_id = $id_sent.'/'.$id_recei;
            $target_id_rev = $id_recei.'/'.$id_sent;
            $query = $query->andWhere('c.target_id = :target_id OR c.target_id = :target_id_rev')
                ->setParameter('target_id', $target_id)
                ->setParameter('target_id_rev', $target_id_rev);
        }
        $query = $query->andWhere('c.delete_at is null')->orderBy('c.create_date', 'DESC');
        $chat_info = $query->getQuery()->getResult();
        return $chat_info;
    }
}
