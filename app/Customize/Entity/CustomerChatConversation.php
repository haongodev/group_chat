<?php

/*
 * Copyright(c) neurotech CO.,LTD. All Rights Reserved.
 */

namespace Customize\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;
use Eccube\Repository\AbstractRepository;

if (!class_exists('\Customize\Entity\CustomerChatConversation')) {
    /**
     * CustomerSiteInfo
     *
     * @ORM\Table(name="dtb_customer_chat_conversation")
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Customize\Repository\CustomerChatConverSationRepository")
     */
    class CustomerChatConversation extends AbstractEntity
    {
        /**
         * @var \Customize\Entity\CustomerChatInfo
         *
         * @ORM\ManyToOne(targetEntity="Customize\Entity\CustomerChatInfo",fetch="EAGER", inversedBy="conversation")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="chat_info_id", referencedColumnName="id")
         * })
         */
        private $ChatInfo;

        /**
         * @var int
         *
         * @ORM\Column(name="id", type="integer", options={"unsigned":true})serialize
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        /**
         * @var int
         *
         * @ORM\Column(name="chat_info_id", type="integer")
         */
        private $chat_info_id;

        /**
         * @var int
         *
         * @ORM\Column(name="register_id", type="integer")
         */
        private $register_id;

        /**
         * @var string|null
         *
         * @ORM\Column(name="register_name", type="string", length=255)
         */
        private $register_name;

        /**
         * @var string|null
         *
         * @ORM\Column(name="chat_class", type="string", length=255)
         */
        private $chat_class;

        /**
         * @var string|null
         *
         * @ORM\Column(name="chat_string", type="text", nullable=true)
         */
        private $chat_string;

        /**
         * @var string|null
         *
         * @ORM\Column(name="file_name", type="string", length=255, nullable=true)
         */
        private $file_name;

        /**
         * @var DateTime
         *
         * @ORM\Column(name="create_date", type="datetimetz")
         */
        private $create_date;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="delete_at", type="datetimetz")
         */
        private $delete_at;

        /**
         * Get chat.
         *
         * @return \Customize\Entity\CustomerChatInfo|null
         */
        public function getChatInfo()
        {
            return $this->ChatInfo;
        }
        /**
         * Get info id.
         *
         * @return \Customize\Entity\CustomerChatInfo|null
         */
        public function getChatInfoId()
        {
            return $this->chat_info_id;
        }
        /**
         * Get chat_file_name.
         *
         * @return string
         */
        public function getFileName()
        {
            return $this->file_name;
        }
        /**
         * Set chat_file_name.
         *
         * @param string $file_name
         *
         * @return CustomerChatConversation
         */
        public function setFileName($file_name)
        {
            $this->file_name = $file_name;
            return $this;
        }
        /**
         * Get chat_string.
         *
         * @return string
         */
        public function getChatString()
        {
            return $this->chat_string;
        }

        /**
         * Set chat_string.
         *
         * @param string $String
         *
         * @return CustomerChatConversation
         */
        public function setChatString($String)
        {
            $this->chat_string = $String;
            return $this;
        }
        /**
         * Get chat_class.
         *
         * @return string
         */
        public function getChatClass()
        {
            return $this->chat_class;
        }

        /**
         * Set chat_class.
         *
         * @param string $String
         *
         * @return CustomerChatConversation
         */
        public function setChatClass($String)
        {
            $this->chat_class = $String;
            return $this;
        }

        /**
         * Set ChatInfo.
         *
         * @param integer $id
         *
         * @return CustomerChatConversation
         */

        public function setChatInfo(CustomerChatInfo $chatInfo = null)
        {
            $this->ChatInfo = $chatInfo;
            return $this;
        }

        /**
         * Get register_name.
         *
         * @return string
         */
        public function getRegisterName()
        {
            return $this->register_name;
        }

        /**
         * Set register_name.
         *
         * @param string $String
         *
         * @return CustomerChatConversation
         */
        public function setRegisterName($String)
        {
            $this->register_name = $String;
            return $this;
        }
        /**
         * Get register_id.
         *
         * @return int
         */
        public function getRegisterId()
        {
            return $this->register_id;
        }

        /**
         * Set register_id.
         *
         * @param integer $id
         *
         * @return CustomerChatConversation
         */

        public function setRegisterId($id)
        {
            $this->register_id = $id;
            return $this;
        }
        /**
         * Get create_data.
         *
         * @return /DateTime
         */
        public function getCreateDate()
        {
            return $this->create_date;
        }
        /**
         * Set create_date.
         *
         * @param \DateTime $time
         *
         * @return CustomerChatConversation
         */
        public function setCreateDate($time = null)
        {
            $this->create_date = $time;
            return $this;
        }
    }
}
