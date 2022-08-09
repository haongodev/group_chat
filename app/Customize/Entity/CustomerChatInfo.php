<?php

/*
 * Copyright(c) neurotech CO.,LTD. All Rights Reserved.
 */

namespace Customize\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;
use Eccube\Repository\AbstractRepository;

if (!class_exists('\Customize\Entity\CustomerChatInfo')) {
    /**
     * CustomerSiteInfo
     *
     * @ORM\Table(name="dtb_customer_chat_info", indexes={@ORM\Index(name="dtb_chat_id", columns={"id"}), @ORM\Index(name="target_id", columns={"target_id"}), @ORM\Index(name="target_class", columns={"target_class"})})
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Customize\Repository\CustomerChatRepository")
     */
    class CustomerChatInfo extends AbstractEntity
    {
        /**
        * @ORM\OneToMany(targetEntity="Customize\Entity\CustomerChatConversation", mappedBy="ChatInfo", cascade={"persist","remove"})
        */
        private $conversation;

        public function __construct()
        {
            $this->conversation = new ArrayCollection();
        }
        /**
         * @var int
         *
         * @ORM\Column(name="id", type="integer", options={"unsigned":true})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        /**
         * @var int
         *
         * @ORM\Column(name="target_class", type="integer", length=11)
         */
        private $target_class;

        /**
         * @var string|null
         *
         * @ORM\Column(name="target_id", type="string", length=255)
         */
        private $target_id;

        /**
         * @var DateTime
         *
         * @ORM\Column(name="create_date", type="datetimetz")
         */
        private $create_date;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="update_date", type="datetimetz")
         */
        private $update_date;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="delete_at", type="datetimetz")
         */
        private $delete_at;
        /**
         * Set id.
         *
         * @param integer|null $id
         *
         * @return CustomerChatInfo
         */
        public function setId($id = null)
        {
            $this->id = $id;
            return $this;
        }

        /**
         * Get id.
         *
         * @return int
         */
        public function getId()
        {
            return $this->id;
        }
        /**
         * Set target_class.
         *
         * @param integer|null $class
         *
         * @return CustomerChatInfo
         */
        public function setTargetClass($class = null)
        {
            $this->target_class = $class;
            return $this;
        }

        /**
         * Get id.
         *
         * @return int
         */
        public function getTargetClass()
        {
            return $this->target_class;
        }

        /**
         * Set target_id.
         *
         * @param string|null $target_id
         *
         * @return CustomerChatInfo
         */
        public function setTargetId($target_id = null)
        {
            $this->target_id = $target_id;
            return $this;
        }

        /**
         * Get id.
         *
         * @return string
         */
        public function getTargetId()
        {
            return $this->target_id;
        }

        /**
         * Set delete_at.
         *
         * @param \DateTime $time
         *
         * @return CustomerChatInfo
         */
        public function setDeleteAt($time = null)
        {
            $this->delete_at = $time;
            return $this;
        }

        /**
         * Get id.
         *
         * @return \DateTime
         */
        public function getDeleteAt()
        {
            return $this->delete_at;
        }
        /**
         * Set create_date.
         *
         * @param \DateTime $time
         *
         * @return CustomerChatInfo
         */
        public function setCreateDate($time = null)
        {
            $this->create_date = $time;
            return $this;
        }

        /**
         * Get id.
         *
         * @return \DateTime
         */
        public function getCreateDate()
        {
            return $this->create_date;
        }
        /**
         * @return Collection|CustomerChatConversation[]
         */
        public function getConversation(): Collection
        {
            return $this->conversation;
        }
    }
}
