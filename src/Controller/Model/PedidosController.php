<?php


namespace App\Controller\Model;

use AlterPHP\EasyAdminExtensionBundle\Controller\EasyAdminController as BaseAdminController;
use App\Entity\Clientes;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PedidosController extends BaseAdminController
{
    // Sobreescribimos el método createListQueryBuilder para filtrar los pedidos de cada representante en los listados
    protected function createListQueryBuilder($entityClass, $sortDirection, $sortField = null, $dqlFilter = null)
    {
        // Sólo filtramos para los representantes, no para los administradores
        if (!$this->isGranted('ROLE_SUPER_ADMIN')) {
            // Filtro dql para mostrar sólo los pedidos del representante que está logeado
            if (null === $dqlFilter) {
                $dqlFilter = sprintf('entity.representante = %s', $this->getUser()->getId());
            } else {
                $dqlFilter .= sprintf(' AND entity.representante = %s', $this->getUser()->getId());
            }
        }
        return parent::createListQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter);

    }

    // Creamos el método dinámico create<NombreEntity>FormBuilder (sustituir <NombreEntity> por el nombre de la entidad o clase correspondiente)
    // para modificar el formulario de creación de pedidos filtrando el campo clientes por representantes
    public function createCabepedvEntityFormBuilder($entity, $view)
    {
// TODO Borrar var_dump
        //var_dump($_GET);
        //die();
        // Cargamos en la variable $formBuilder la salida de la función sobreescrita
        $formBuilder = parent::createEntityFormBuilder($entity, $view);

        // Si no es superadmin (el superadmin tiene acceso total)
        if (!$this->isGranted('ROLE_SUPER_ADMIN')) {

//            // prueba 1
//            $user = $this->getUser();
//
//            $clientes = $this->getDoctrine()
//                ->getRepository(Clientes::class)
//                ->findByRepresentanteField($user);
//            $formBuilder->add(
//                'clientes', EntityType::class, [
//                'class' => Clientes::class,
//                'query_builder' => $clientes,
//                "attr" => ["class" => "form-control select2", "data-widget" => "select2"],
//                'by_reference' => false,
//                'multiple' => true,
//                'required' => false
//
//                ]
//            );
//
            // Obtenemos el id del usuario conectado
            $user = $this->getUser()->getId();

            // Añadimos el campo representante al formulario filtrado para el representante conectado
            // ver el createQueryBuilder: clausula where
            $formBuilder->add('representante', EntityType::class, [
                'class' => 'App\Entity\User',
                'query_builder' => function (EntityRepository $er) use ($user) {
                    return $er->createQueryBuilder('u')
                        ->where('u = :user')
                        ->setParameter('user', $user);
                },
                "attr" => ["class" => "form-control select2", "data-widget" => "select2"],
                // OJO: by:reference debe estar a true (que es el valor por defecto y por tanto se puede omitir),
                // de lo contrario intentará acceder directamente a los getter y setter de la entity padre (User): $user->getId()
                // que no está manejada por este controller y provocará un error.
                // Siendo true accedera a traves de $cabepedv->getRepresentante()->getId()
                // Ver https://symfony.com/doc/current/reference/forms/types/form.html#by-reference
                'by_reference' => true,
                'multiple' => false,
                'required' => true
            ]);

            // Añadimos el campo cliente al formulario filtrado para los clientes del representante conectado
            // ver el createQueryBuilder: clausula where
            $formBuilder->add('cliente', EntityType::class, [
                'class' => Clientes::class,
                'query_builder' => function (EntityRepository $er) use ($user) {
                    return $er->createQueryBuilder('c')
                        ->andwhere( 'c.activo = true')
                        ->andwhere('c.representante = :user')
                        ->setParameter('user', $user);
                },
                "attr" => ["class" => "form-control select2", "data-widget" => "select2"],
                // OJO: by:reference debe estar a true (que es el valor por defecto y por tanto se puede omitir),
                // de lo contrario intentará acceder directamente a los getter y setter de la entity padre (Clientes): $Cliente->getId()
                // que no está manejada por este controller y provocará un error.
                // Siendo true accedera a traves de $cabepedv->getCliente()->getId()
                // Ver https://symfony.com/doc/current/reference/forms/types/form.html#by-reference
                'by_reference' => true,
                'multiple' => false,
                'required' => true,
                'group_by' => 'pobcli'
            ]);

        }

        // Devolvemos el formBuilder modificado (si no es superadmin) u original (si es superadmin)

        return $formBuilder;
    }

//    /**
//     * Creates the form object used to create or edit the given entity.
//     *
//     * @param object $entity
//     * @param array  $entityProperties
//     * @param string $view
//     *
//     * @return FormInterface
//     *
//     * @throws \Exception
//     */
//    protected function createCabepedvEntityForm($entity, array $entityProperties, $view)
//    {
////        if (method_exists($this, $customMethodName = 'create'.$this->entity['name'].'EntityForm')) {
////            $form = $this->{$customMethodName}($entity, $entityProperties, $view);
////            if (!$form instanceof FormInterface) {
////                throw new \UnexpectedValueException(sprintf(
////                    'The "%s" method must return a FormInterface, "%s" given.',
////                    $customMethodName, \is_object($form) ? \get_class($form) : \gettype($form)
////                ));
////            }
////
////            return $form;
////        }
//
//        $formBuilder = $this->executeDynamicMethod('create<EntityName>EntityFormBuilder', [$entity, $view]);
//
//
//        if (!$formBuilder instanceof FormBuilderInterface) {
//            throw new \UnexpectedValueException(sprintf(
//                'The "%s" method must return a FormBuilderInterface, "%s" given.',
//                'createEntityForm', \is_object($formBuilder) ? \get_class($formBuilder) : \gettype($formBuilder)
//            ));
//        }
//
//        return $formBuilder->getForm();
//    }
}