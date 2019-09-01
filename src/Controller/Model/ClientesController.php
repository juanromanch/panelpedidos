<?php
// revisar https://github.com/EasyCorp/EasyAdminBundle/issues/1405
// revisar https://stackoverflow.com/questions/50877535/symfony-easyadminbundle-dql-filter-entities-in-assotiation-field-on-list-not-wo
// revisar https://jaromero.es/symfony-entitytype-formularios/
// revisar https://www.strangebuzz.com/en/snippets/use-a-custom-query-builder-in-yaml-with-the-easyadmin-bundle-to-configure-entities-widgets
// revisar https://stackoverflow.com/questions/40197724/symfony-easyadminbundle-filter-entities-in-assotiation-field
// revisar https://symfony.com/doc/current/reference/forms/types/entity.html#ref-form-entity-query-builder
// revisar https://stackoverflow.com/questions/40197724/symfony-easyadminbundle-filter-entities-in-assotiation-field
// revisar https://stackoverflow.com/questions/52760517/dql-filter-in-query-with-easyadminbundle



namespace App\Controller\Model;

use AlterPHP\EasyAdminExtensionBundle\Controller\EasyAdminController as BaseAdminController;


class ClientesController extends BaseAdminController
{
    // Sobreescribimos el método createListQueryBuilder para filtrar los pedidos de cada representante en los listados
    protected function createListQueryBuilder($entityClass, $sortDirection, $sortField = null, $dqlFilter = null)
    {
        // Sólo filtramos para los representantes, no para los administradores
        if (!$this->isGranted('ROLE_SUPER_ADMIN')) {
            // Filtro dql para mostrar sólo los pedidos del representante que está logeado
            if (null === $dqlFilter) {
                $dqlFilter = sprintf('entity.representante = %s AND entity.activo = true', $this->getUser()->getId());
            } else {
                $dqlFilter .= sprintf(' AND entity.representante = %s AND entity.activo = true', $this->getUser()->getId());
            }
        }
        return parent::createListQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter);

    }

//    /**
//     * Admin filter: don't display past events.
//     */
//    public static function filtraClientesPorRepresentante(ClientesRepository $r): QueryBuilder
//    {
//        $user = $this->getUser()->getId();
//        return $r->createQueryBuilder('c')
//            ->innerJoin('c.representante', 'r')
//            ->where('r.id = :representante')
//            ->setParameter('representante', $user)
//            ->groupBy( 'c.pobcli')
//            ->orderBy('c.nomcli', 'ASC');
//    }
}
