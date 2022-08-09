<?php

/*
 * Copyright(c) neurotech CO.,LTD. All Rights Reserved.
 */

namespace Customize\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Entity\AbstractEntity;
use Eccube\Repository\AbstractRepository;

if (!class_exists('\Customize\Entity\CustomerSiteInfo')) {
    /**
     * CustomerSiteInfo
     *
     * @ORM\Table(name="dtb_customer_site_info")
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Customize\Repository\CustomerSiteInfoRepository")
     */
    class CustomerSiteInfo extends AbstractEntity
    {
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
         * @ORM\Column(name="customer_id", type="integer", options={"unsigned":true})
         */
        private $customer_id;

        /**
         * @var string|null
         *
         * @ORM\Column(name="site_name", type="string", length=255)
         */
        private $site_name;

        /**
         * @var string|null
         *
         * @ORM\Column(name="owner01", type="string", length=255)
         */
        private $owner01;

        /**
         * @var string|null
         *
         * @ORM\Column(name="owner02", type="string", length=255)
         */
        private $owner02;

        /**
         * @var string|null
         *
         * @ORM\Column(name="owner_kana01", type="string", length=255, nullable=true)
         */
        private $owner_kana01;

        /**
         * @var string|null
         *
         * @ORM\Column(name="owner_kana02", type="string", length=255, nullable=true)
         */
        private $owner_kana02;

        /**
         * @var string|null
         *
         * @ORM\Column(name="company_name", type="string", length=255, nullable=true)
         */
        private $company_name;

        /**
         * @var string|null
         *
         * @ORM\Column(name="postal_code", type="string", length=8, nullable=true)
         */
        private $postal_code;

        /**
         * @var string|null
         *
         * @ORM\Column(name="addr01", type="string", length=255, nullable=true)
         */
        private $addr01;

        /**
         * @var string|null
         *
         * @ORM\Column(name="addr02", type="string", length=255, nullable=true)
         */
        private $addr02;

        /**
         * @var string|null
         *
         * @ORM\Column(name="company_phone_number", type="string", length=14, nullable=true)
         */
        private $company_phone_number;

        /**
         * @var string|null
         *
         * @ORM\Column(name="emergency_phone_number", type="string", length=14, nullable=true)
         */
        private $emergency_phone_number;

        /**
         * @var string|null
         *
         * @ORM\Column(name="manager01", type="string", length=255)
         */
        private $manager01;

        /**
         * @var string|null
         *
         * @ORM\Column(name="manager02", type="string", length=255)
         */
        private $manager02;

        /**
         * @var string|null
         *
         * @ORM\Column(name="manager_kana01", type="string", length=255)
         */
        private $manager_kana01;

        /**
         * @var string|null
         *
         * @ORM\Column(name="manager_kana02", type="string", length=255)
         */
        private $manager_kana02;

        /**
         * @var DateTime
         *
         * @ORM\Column(name="construction_period_start", type="datetimetz")
         */
        private $construction_period_start;

        /**
         * @var DateTime
         *
         * @ORM\Column(name="construction_period_end", type="datetimetz")
         */
        private $construction_period_end;

        /**
         * @var string|null
         *
         * @ORM\Column(name="key_info", type="string", length=255)
         */
        private $key_info;

        /**
         * @var string|null
         *
         * @ORM\Column(name="important_point", type="string", length=1000)
         */
        private $important_point;

        /**
         * @var string|null
         *
         * @ORM\Column(name="note", type="string", length=1000)
         */
        private $note;

        /**
         * @var int
         *
         * @ORM\Column(name="status", type="integer", options={"unsigned":true})
         */
        private $status;

        /**
         * @var \DateTime
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
         * @var \Eccube\Entity\Customer
         *
         * @ORM\ManyToOne(targetEntity="Eccube\Entity\Customer", inversedBy="CustomerSiteInfo")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
         * })
         */
        private $Customer;

        /**
         * @var \Eccube\Entity\Master\Pref
         *
         * @ORM\ManyToOne(targetEntity="Eccube\Entity\Master\Pref")
         * @ORM\JoinColumns({
         *   @ORM\JoinColumn(name="pref_id", referencedColumnName="id")
         * })
         */
        private $Pref;

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
         * Set customer_id.
         *
         * @param integer|null $customer_id
         *
         * @return CustomerSiteInfo
         */
        public function setCustomerId($customer_id = null)
        {
            $this->customer_id = $customer_id;

            return $this;
        }

        /**
         * Get customer_id.
         *
         * @return int
         */
        public function getCustomerId()
        {
            return $this->customer_id;
        }

        /**
         * Set site_name.
         *
         * @param string|null $site_name
         *
         * @return CustomerSiteInfo
         */
        public function setSiteName($site_name = null)
        {
            $this->site_name = $site_name;

            return $this;
        }

        /**
         * Get site_name.
         *
         * @return string|null
         */
        public function getSiteName()
        {
            return $this->site_name;
        }

        /**
         * Set owner01.
         *
         * @param string|null $owner01
         *
         * @return CustomerSiteInfo
         */
        public function setOwner01($owner01 = null)
        {
            $this->owner01 = $owner01;

            return $this;
        }

        /**
         * Get owner01.
         *
         * @return string|null
         */
        public function getOwner01()
        {
            return $this->owner01;
        }

        /**
         * Set owner02.
         *
         * @param string|null $owner02
         *
         * @return CustomerSiteInfo
         */
        public function setOwner02($owner02 = null)
        {
            $this->owner02 = $owner02;

            return $this;
        }

        /**
         * Get owner02.
         *
         * @return string|null
         */
        public function getOwner02()
        {
            return $this->owner02;
        }

        /**
         * Set owner_kana01.
         *
         * @param string|null $owner_kana01
         *
         * @return CustomerSiteInfo
         */
        public function setOwnerKana01($owner_kana01 = null)
        {
            $this->owner_kana01 = $owner_kana01;

            return $this;
        }

        /**
         * Get owner_kana01.
         *
         * @return string|null
         */
        public function getOwnerKana01()
        {
            return $this->owner_kana01;
        }

        /**
         * Set owner_kana02.
         *
         * @param string|null $owner_kana02
         *
         * @return CustomerSiteInfo
         */
        public function setOwnerKana02($owner_kana02 = null)
        {
            $this->owner_kana02 = $owner_kana02;

            return $this;
        }

        /**
         * Get owner_kana02.
         *
         * @return string|null
         */
        public function getOwnerKana02()
        {
            return $this->owner_kana02;
        }

        /**
         * Set companyName.
         *
         * @param string|null $companyName
         *
         * @return CustomerSiteInfo
         */
        public function setCompanyName($companyName = null)
        {
            $this->company_name = $companyName;

            return $this;
        }

        /**
         * Get companyName.
         *
         * @return string|null
         */
        public function getCompanyName()
        {
            return $this->company_name;
        }

        /**
         * Set postal_code.
         *
         * @param string|null $postal_code
         *
         * @return CustomerSiteInfo
         */
        public function setPostalCode($postal_code = null)
        {
            $this->postal_code = $postal_code;

            return $this;
        }

        /**
         * Get postal_code.
         *
         * @return string|null
         */
        public function getPostalCode()
        {
            return $this->postal_code;
        }

        /**
         * Set addr01.
         *
         * @param string|null $addr01
         *
         * @return CustomerSiteInfo
         */
        public function setAddr01($addr01 = null)
        {
            $this->addr01 = $addr01;

            return $this;
        }

        /**
         * Get addr01.
         *
         * @return string|null
         */
        public function getAddr01()
        {
            return $this->addr01;
        }

        /**
         * Set addr02.
         *
         * @param string|null $addr02
         *
         * @return CustomerSiteInfo
         */
        public function setAddr02($addr02 = null)
        {
            $this->addr02 = $addr02;

            return $this;
        }

        /**
         * Get addr02.
         *
         * @return string|null
         */
        public function getAddr02()
        {
            return $this->addr02;
        }

        /**
         * Set company_phone_number.
         *
         * @param string|null $company_phone_number
         *
         * @return CustomerSiteInfo
         */
        public function setCompanyPhoneNumber($company_phone_number = null)
        {
            $this->company_phone_number = $company_phone_number;

            return $this;
        }

        /**
         * Get company_phone_number.
         *
         * @return string|null
         */
        public function getCompanyPhoneNumber()
        {
            return $this->company_phone_number;
        }

        /**
         * Set emergency_phone_number.
         *
         * @param string|null $emergency_phone_number
         *
         * @return CustomerSiteInfo
         */
        public function setEmergencyPhoneNumber($emergency_phone_number = null)
        {
            $this->emergency_phone_number = $emergency_phone_number;

            return $this;
        }

        /**
         * Get emergency_phone_number.
         *
         * @return string|null
         */
        public function getEmergencyPhoneNumber()
        {
            return $this->emergency_phone_number;
        }

        /**
         * Set construction_period_start.
         *
         * @param \DateTime $construction_period_start
         *
         * @return CustomerSiteInfo
         */
        public function setConstructionPeriodStart($construction_period_start)
        {
            $this->construction_period_start = $construction_period_start;

            return $this;
        }

        /**
         * Get construction_period_start.
         *
         * @return \DateTime
         */
        public function getConstructionPeriodStart()
        {
            return $this->construction_period_start;
        }

        /**
         * Set construction_period_end.
         *
         * @param \DateTime $construction_period_end
         *
         * @return CustomerSiteInfo
         */
        public function setConstructionPeriodEnd($construction_period_end)
        {
            $this->construction_period_end = $construction_period_end;

            return $this;
        }

        /**
         * Get construction_period_end.
         *
         * @return \DateTime
         */
        public function getConstructionPeriodEnd()
        {
            return $this->construction_period_end;
        }

        /**
         * Set manager01.
         *
         * @param string|null $manager01
         *
         * @return CustomerSiteInfo
         */
        public function setManager01($manager01 = null)
        {
            $this->manager01 = $manager01;

            return $this;
        }

        /**
         * Get manager01.
         *
         * @return string|null
         */
        public function getManager01()
        {
            return $this->manager01;
        }

        /**
         * Set manager02.
         *
         * @param string|null $manager02
         *
         * @return CustomerSiteInfo
         */
        public function setManager02($manager02 = null)
        {
            $this->manager02 = $manager02;

            return $this;
        }

        /**
         * Get manager02.
         *
         * @return string|null
         */
        public function getManager02()
        {
            return $this->manager02;
        }

        /**
         * Set manager_kana01.
         *
         * @param string|null $manager_kana01
         *
         * @return CustomerSiteInfo
         */
        public function setManagerKana01($manager_kana01 = null)
        {
            $this->manager_kana01 = $manager_kana01;

            return $this;
        }

        /**
         * Get manager_kana01.
         *
         * @return string|null
         */
        public function getManagerKana01()
        {
            return $this->manager_kana01;
        }

        /**
         * Set manager_kana02.
         *
         * @param string|null $manager_kana02
         *
         * @return CustomerSiteInfo
         */
        public function setManagerKana02($manager_kana02 = null)
        {
            $this->manager_kana02 = $manager_kana02;

            return $this;
        }

        /**
         * Get manager_kana02.
         *
         * @return string|null
         */
        public function getManagerKana02()
        {
            return $this->manager_kana02;
        }

        /**
         * Set key_info.
         *
         * @param string|null $key_info
         *
         * @return CustomerSiteInfo
         */
        public function setKeyInfo($key_info = null)
        {
            $this->key_info = $key_info;

            return $this;
        }

        /**
         * Get key_info.
         *
         * @return string|null
         */
        public function getKeyInfo()
        {
            return $this->key_info;
        }

        /**
         * Set important_point.
         *
         * @param string|null $important_point
         *
         * @return CustomerSiteInfo
         */
        public function setImportantPoint($important_point = null)
        {
            $this->important_point = $important_point;

            return $this;
        }

        /**
         * Get important_point.
         *
         * @return string|null
         */
        public function getImportantPoint()
        {
            return $this->important_point;
        }

        /**
         * Set note.
         *
         * @param string|null $note
         *
         * @return CustomerSiteInfo
         */
        public function setNote($note = null)
        {
            $this->note = $note;

            return $this;
        }

        /**
         * Get note.
         *
         * @return string|null
         */
        public function getNote()
        {
            return $this->note;
        }

        /**
         * Set createDate.
         *
         * @param \DateTime $createDate
         *
         * @return CustomerSiteInfo
         */
        public function setCreateDate($createDate)
        {
            $this->create_date = $createDate;

            return $this;
        }

        /**
         * Get createDate.
         *
         * @return \DateTime
         */
        public function getCreateDate()
        {
            return $this->create_date;
        }

        /**
         * Set updateDate.
         *
         * @param \DateTime $updateDate
         *
         * @return CustomerSiteInfo
         */
        public function setUpdateDate($updateDate)
        {
            $this->update_date = $updateDate;

            return $this;
        }

        /**
         * Get updateDate.
         *
         * @return \DateTime
         */
        public function getUpdateDate()
        {
            return $this->update_date;
        }

        /**
         * Set customer.
         *
         * @param \Eccube\Entity\Customer|null $customer
         *
         * @return CustomerSiteInfo
         */
        public function setCustomer(\Eccube\Entity\Customer $customer = null)
        {
            $this->Customer = $customer;

            return $this;
        }

        /**
         * Get customer.
         *
         * @return \Eccube\Entity\Customer|null
         */
        public function getCustomer()
        {
            return $this->Customer;
        }

        /**
         * Set pref.
         *
         * @param \Eccube\Entity\Master\Pref|null $pref
         *
         * @return CustomerSiteInfo
         */
        public function setPref(\Eccube\Entity\Master\Pref $pref = null)
        {
            $this->Pref = $pref;

            return $this;
        }

        /**
         * Get pref.
         *
         * @return \Eccube\Entity\Master\Pref|null
         */
        public function getPref()
        {
            return $this->Pref;
        }

        /**
         * Set status.
         *
         * @param integer|null $status
         *
         * @return CustomerSiteInfo
         */
        public function setStatus($status = null)
        {
            $this->status = $status;

            return $this;
        }

        /**
         * Get status.
         *
         * @return int
         */
        public function getStatus()
        {
            return $this->status;
        }

        /**
         * getShippingMultipleDefaultName
         *
         * @return string
         */
        public function getShippingMultipleDefaultName()
        {
            return $this->getManager01().'／'.$this->getPref()->getName().' '.$this->getAddr01().' '.$this->getAddr02();
        }
    }
}
