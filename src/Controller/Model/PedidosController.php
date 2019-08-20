<?php


namespace App\Controller\Model;

use AlterPHP\EasyAdminExtensionBundle\Controller\EasyAdminController as BaseAdminController;


class PedidosController extends BaseAdminController
{
    // Sobreescribimos el método createListQueryBuilder para filtrar los pedidos de cada representante
    protected function createListQueryBuilder($entityClass, $sortDirection, $sortField = null, $dqlFilter = null)
    {
        if (!$this->isGranted('ROLE_SUPER_ADMIN')) {
            if (null === $dqlFilter) {
                $dqlFilter = sprintf('entity.representante = %s', $this->getUser()->getId());
            } else {
                $dqlFilter .= sprintf(' AND entity.representante = %s', $this->getUser()->getId());
            }
        }
        return parent::createListQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter);

    }

}