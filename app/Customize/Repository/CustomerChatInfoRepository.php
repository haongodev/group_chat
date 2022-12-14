<?php

/*
 * Copyright(c) neurotech CO.,LTD. All Rights Reserved.
 */

namespace Customize\Repository;

use Customize\Entity\CustomerChatInfo;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Eccube\Repository\AbstractRepository;

/**
 * CustomerChatInfoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CustomerChatInfoRepository extends AbstractRepository
{
    /**
     * CustomerChatInfoRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomerChatInfo::class);
    }

    public function newChat()
    {
        $Chat = new CustomerChatInfo();
        return $Chat;
    }
}
