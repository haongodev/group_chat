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

namespace Eccube\Repository;

use Doctrine\DBAL\Exception\DriverException;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Eccube\Common\EccubeConfig;
use Eccube\Entity\Category;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends AbstractRepository
{
    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;

    /**
     * CategoryRepository constructor.
     *
     * @param RegistryInterface $registry
     * @param EccubeConfig $eccubeConfig
     */
    public function __construct(
        RegistryInterface $registry,
        EccubeConfig $eccubeConfig
    ) {
        parent::__construct($registry, Category::class);
        $this->eccubeConfig = $eccubeConfig;
    }

    /**
     * 全カテゴリの合計を取得する.
     *
     * @return int 全カテゴリの合計数
     */
    public function getTotalCount()
    {
        return $this
            ->createQueryBuilder('c')
            ->select('COALESCE(COUNT(c.id), 0)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * カテゴリ一覧を取得する.
     *
     * 引数 $Parent を指定した場合は, 指定したカテゴリの子以下を取得する.
     *
     * @param Category|null $Parent 指定の親カテゴリ
     * @param bool $flat trueの場合, 階層化されたカテゴリを一つの配列にまとめる
     *
     * @return Category[] カテゴリの配列
     */
    public function getList(Category $Parent = null, $flat = false)
    {
        $qb = $this->createQueryBuilder('c1')
            ->select('c1, c2, c3, c4, c5')
            ->leftJoin('c1.Children', 'c2')
            ->leftJoin('c2.Children', 'c3')
            ->leftJoin('c3.Children', 'c4')
            ->leftJoin('c4.Children', 'c5')
            ->orderBy('c1.sort_no', 'DESC')
            ->addOrderBy('c2.sort_no', 'DESC')
            ->addOrderBy('c3.sort_no', 'DESC')
            ->addOrderBy('c4.sort_no', 'DESC')
            ->addOrderBy('c5.sort_no', 'DESC');

        if ($Parent) {
            $qb->where('c1.Parent = :Parent')->setParameter('Parent', $Parent);
        } else {
            $qb->where('c1.Parent IS NULL');
        }
        $Categories = $qb->getQuery()
            ->useResultCache(true, $this->getCacheLifetime())
            ->getResult();

        if ($flat) {
            $array = [];
            foreach ($Categories as $Category) {
                $array = array_merge($array, $Category->getSelfAndDescendants());
            }
            $Categories = $array;
        }

        return $Categories;
    }

    /**
     * カテゴリを保存する.
     *
     * @param  Category $Category カテゴリ
     */
    public function save($Category)
    {
        if (!$Category->getId()) {
            $Parent = $Category->getParent();
            if ($Parent) {
                $sortNo = $Parent->getSortNo() - 1;
            } else {
                $sortNo = $this->createQueryBuilder('c')
                    ->select('COALESCE(MAX(c.sort_no), 0)')
                    ->getQuery()
                    ->getSingleScalarResult();
            }

            $Category->setSortNo($sortNo + 1);

            $this
                ->createQueryBuilder('c')
                ->update()
                ->set('c.sort_no', 'c.sort_no + 1')
                ->where('c.sort_no > :sort_no')
                ->setParameter('sort_no', $sortNo)
                ->getQuery()
                ->execute();
        }

        $em = $this->getEntityManager();
        $em->persist($Category);
        $em->flush($Category);
    }

    /**
     * カテゴリを削除する.
     *
     * @param  Category $Category 削除対象のカテゴリ
     *
     * @throws ForeignKeyConstraintViolationException 外部キー制約違反の場合
     * @throws DriverException SQLiteの場合, 外部キー制約違反が発生すると, DriverExceptionをthrowします.
     */
    public function delete($Category)
    {
        $this
            ->createQueryBuilder('c')
            ->update()
            ->set('c.sort_no', 'c.sort_no - 1')
            ->where('c.sort_no > :sort_no')
            ->setParameter('sort_no', $Category->getSortNo())
            ->getQuery()
            ->execute();

        $em = $this->getEntityManager();
        $em->remove($Category);
        $em->flush($Category);
    }
}
